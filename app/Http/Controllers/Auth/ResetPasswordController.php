<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use App\Mail\PasswordReset;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Request $request){

        return view('auth.passwords.email');

    }

    public function send(Request $request){

        $email = $request->input('email');

        $user_email = User::where('email','=',$email)->first();

        if($user_email == NULL) {

            $request->session()->flash('danger', 'Пользователь с такой почтой не найден');

        }
        if($user_email != NULL){

            $user = User::find($user_email->id);
            $user->token = str_random(16);
            $user->save();

            Mail::to($user)->send(new PasswordReset($user));

            $request->session()->flash('status', 'Письмо с ссылкой на восстановление пароля отправлено на почту');
        }

        return redirect()->back();
    }

    public function reset(Request $request, $token){

        $user = User::whereToken($token)->first();


        return view('auth.passwords.reset')
            ->with('user',$user);
    }

    public function save(Request $request)
    {

        $this->validate($request,['password' => 'required|string|min:8|confirmed']);

        $id = $request->input('id');
        $pass = bcrypt($request->input('password'));

            $reset = User::find($id);
            $reset->password = $pass;
            $reset->token = NULL;
            $reset->save();

        return redirect('/');
    }

}
