<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $length = 30;
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rand = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            $user->token = $rand;
        });
    }
    protected function signIn(Request $request)
    {
        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
    }

    protected $fillable = [
        'name', 'email', 'password','phone','key_sum','info','verified','token'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function confirmEmail()
    {
        $this->verified = true;
        $this->save();
    }
    public function cleanToken(){
        $this->token = null;
        $this->save();
    }

    protected function getCredentials(Request $request)
    {
        return [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'verified' => 1
        ];
    }
}
