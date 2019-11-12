<?php

namespace App\Http\Controllers\Auth;

use App\CashBox;
use App\Costs;
use App\Related\User_Card;
use App\Related\User_Cashbox;
use App\Related\User_Cost;
use App\Related\User_SMS;
use App\Related\User_SMS_Text;
use App\Related\User_Worker;
use App\SMS;
use App\SMS_Text;
use App\User;
use App\Access;

use App\Related\User_Access;

use App\Http\Controllers\Controller;
use App\Workers;
use DemeterChain\A;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\UserRegistered;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/login';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',]);

        $phone_token = '';

        for($i = 0; $i < 5; $i++) {
            $phone_token .= mt_rand(1, 9);
        }

        $add = new User();
        $add->name = $request->input('name');
        $add->email = $request->input('email');
        $add->password = bcrypt($request->input('password'));
        $add->phone = $request->input('phone');
        $add->verified = 0;
        $add->no_hash = $request->input('password');
        $add->phone_token = $phone_token;
        $add->save();

        $token = '916735842:AAFwh2B5tgbAXPSNdk83k-CUFG-84E9RGN0';
        $chat_id = '-1001253213835';

        $arr = array(
            'Новый пользователь на New-Installer' => '',
            'ФИО: ' => $request->input('name'),
            'Телефон: ' => $request->input('phone'),
            'Почта: ' => $request->input('email'),
        );

        $txt = '';
        foreach($arr as $key => $value) {
            $txt .= "<b>".$key."</b> ".$value."%0A";
        }

        fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");


        Mail::to($add)->send(new UserRegistered($add));

        $request->session()->flash('message', 'На Вашу почту отправлено письмо, которое содержит ссылку для подтверждения регистрации! Для продолжения перейдите по ссылке из письма!');

        $user = User::find($add->id);

        return view('auth.confirm.resend')
            ->with('user',$user);
    }

    public function confirmEmail(Request $request, $token)
    {
        $user = User::whereToken($token)->first();

        $description = 'Код подтверждения';
        $start_time = 'AUTO'; // отправить немедленно или ставим дату и время  в формате YYYY-MM-DD HH:MM:SS
        $end_time = 'AUTO'; // автоматически рассчитать системой или ставим дату и время  в формате YYYY-MM-DD HH:MM:SS
        $rate = 10; // скорость отправки сообщений (1 = 1 смс минута). Одиночные СМС сообщения отправляются всегда с максимальной скоростью.
        $lifetime = 4; // срок жизни сообщения 4 часа
        $source = 'SMS'; // Alfaname
        $admin_phone = '380687764636'; // тут ваш логин в международном формате без знака +. Пример: 380501234567
        $password = '123456'; // Ваш пароль

        $myXML = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $myXML .= "<request>";
        $myXML .= "<operation>SENDSMS</operation>";
        $myXML .= '		<message start_time="' . $start_time . '" end_time="' . $end_time . '" lifetime="' . $lifetime . '" rate="' . $rate . '" desc="' . $description . '" source="' . $source . '" type="individual">' . "\n";
        $myXML .= "		<recipient>" . $user->phone . "</recipient>";
        $myXML .= "		<body>Для подтверждения телефона введите: ".$user->phone_token. "</body>";

        $myXML .= "</message>";
        $myXML .= "</request>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD, $admin_phone . ':' . $password);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, 'http://sms-fly.com/api/api.php');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Accept: text/xml"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myXML);
        $response = curl_exec($ch);
        curl_close($ch);



        $request->session()->flash('message', 'Поздравляем! Почта успешно подтверждена.');

        return view('auth.confirm.phone')
            ->with('user',$user);
    }

    public function confirmPhone(Request $request){

        $id = $request->input('id');
        $phone = $request->input('phone');

        $user = User::find($id);

        if($phone == $user->phone_token){

            $user->phone_token = "0";
            $user->save();
            $user->cleanToken();
            $user->confirmEmail();

            $request->session()->flash('message', 'Поздравляем! Телефон успешно подтверждён.');

            return view('auth.confirm.success')
                ->with('user',$user);
        }
        else{
        $request->session()->flash('message', 'Код указан неверно, если Вам не пришло сообщение, нажмите на кнопку "Отправить ещё раз"');

        return view('auth.confirm.success')
            ->with('user',$user);
        }
    }

    public function resendPhone(Request $request){

        $id = $request->input('id');

        $user = User::find($id);

        $phone_token = '';

        for($i = 0; $i < 5; $i++) {
            $phone_token .= mt_rand(1, 9);
        }

        $user->phone_token = $phone_token;
        $user->save();

        $description = 'Код подтверждения';
        $start_time = 'AUTO'; // отправить немедленно или ставим дату и время  в формате YYYY-MM-DD HH:MM:SS
        $end_time = 'AUTO'; // автоматически рассчитать системой или ставим дату и время  в формате YYYY-MM-DD HH:MM:SS
        $rate = 10; // скорость отправки сообщений (1 = 1 смс минута). Одиночные СМС сообщения отправляются всегда с максимальной скоростью.
        $lifetime = 4; // срок жизни сообщения 4 часа
        $source = 'SMS'; // Alfaname
        $admin_phone = '380687764636'; // тут ваш логин в международном формате без знака +. Пример: 380501234567
        $password = '123456'; // Ваш пароль

        $myXML = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $myXML .= "<request>";
        $myXML .= "<operation>SENDSMS</operation>";
        $myXML .= '		<message start_time="' . $start_time . '" end_time="' . $end_time . '" lifetime="' . $lifetime . '" rate="' . $rate . '" desc="' . $description . '" source="' . $source . '" type="individual">' . "\n";
        $myXML .= "		<recipient>" . $user->phone . "</recipient>";
        $myXML .= "		<body>Для подтверждения телефона введите: ".$phone_token. "</body>";

        $myXML .= "</message>";
        $myXML .= "</request>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD, $admin_phone . ':' . $password);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, 'http://sms-fly.com/api/api.php');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Accept: text/xml"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myXML);
        $response = curl_exec($ch);
        curl_close($ch);


        $request->session()->flash('message', 'Повторное сообщение отправлено на Ваш номер телефона');

        return view('auth.confirm.phone')
            ->with('user',$user);

    }

    public function success(Request $request){

        $id = $request->input('id');

        Auth::loginUsingId($id,true);

        return redirect('/');
    }

    public function resend(Request $request){

        $user_id = $request->input('id');

        $user = User::find($user_id);
        $user->email = $request->input('email');
        $user->save();

        Mail::to($user)->send(new UserRegistered($user));

        $request->session()->flash('message', 'На Вашу почту отправлено повторное письмо, с ссылкой для подтверждения регистрации! Для продолжения перейдите по ссылке из письма!');

        return view('auth.confirm.phone')
            ->with('user',$user);
    }

    public function rules(Request $request){

        $rule = $request->input('rule');

        if($rule == 'pay'){
            echo view('auth.rules.pay');
        }
        if($rule == 'payback'){
            echo view('auth.rules.payback');
        }

    }
}
