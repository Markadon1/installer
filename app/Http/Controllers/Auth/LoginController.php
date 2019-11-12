<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function enter(Request $request)
    {
        $email = $request->input('email');
        $user = User::all()->where('email','=',$email)->count();
        $u = User::where('email','=',$email)->first();
        if($user != 0){

            if (User::signIn($request) == true) {

                return redirect('/');

            }
            if(Hash::check($request->input('password'), $u->password) == false){
                $request->session()->flash('message','Неверный пароль');
                return redirect()->back();
            }
            if (User::signIn($request) == false){

                $request->session()->flash('message','Вход запрещён,так как вы не авторизировались через почту, либо доступ заблокирован');
                return redirect()->back();

            }
        }

        $request->session()->flash('message','Неверный E-mail или пароль');
        return redirect()->back();

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
