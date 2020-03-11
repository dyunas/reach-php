<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassportMailable extends Mailable
{
  use Queueable, SerializesModels;

  public $pword, $user;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($pword, $user)
  {
    $this->pword = $pword;
    $this->user = $user;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject('Password Reset')->view('password_reset.password_reset_message')->with(['pword' => $this->pword, 'user' => $this->user]);
  }
}
