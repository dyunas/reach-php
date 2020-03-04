<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMailable extends Mailable
{
  use Queueable, SerializesModels;

  public $token, $userId;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($token, $userId)
  {
    $this->token = $token;
    $this->userId = $userId;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject('Registration Verification')->view('email_verification.verification_message')->with(['token' => $this->token, 'userId' => $this->userId]);
  }
}
