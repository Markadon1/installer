<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function build()
    {
        return $this->from('clan.quests@gmail.com')->view('auth.confirm.mail')->subject('Активация пользователя');
    }
}
