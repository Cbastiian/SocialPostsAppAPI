<?php

namespace App\Mail\Api\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMailiable extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $token;
    public int $expireTime;

    public function __construct(
        string $name,
        string $token,
        int $expireTime
    ) {
        $this->name =  $name;
        $this->token =  $token;
        $this->expireTime =  $expireTime;
    }

    public function build()
    {
        return $this->subject('Reestablecer contraseña')->view('emails.password-reset');
    }
}
