<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Worker extends Mailable
{
    use Queueable, SerializesModels;

    public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function build()
    {
        return $this->from('clan.quests@gmail.com')->view('auth.confirm.worker')->subject('Активация пользователя');
    }
}
