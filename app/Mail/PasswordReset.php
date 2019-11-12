<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function build()
    {
        return $this->from('clan.quests@gmail.com')->view('auth.passwords.mail')->subject('Восстановление пароля');
    }
}
