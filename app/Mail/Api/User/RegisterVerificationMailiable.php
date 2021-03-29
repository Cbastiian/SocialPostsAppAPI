<?php

namespace App\Mail\Api\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\ValueObjects\Name;

class RegisterVerificationMailiable extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $otpCode;
    public int $expireTime;

    public function __construct(
        string $name,
        string $otpCode,
        int $expireTime
    ) {
        $this->name = $name;
        $this->otpCode = $otpCode;
        $this->expireTime = $expireTime;
    }

    public function build()
    {
        return $this->subject('Verificación de cuenta')->view('emails.user-register-verification');
    }
}
