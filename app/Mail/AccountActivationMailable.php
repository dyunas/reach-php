<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivationMailable extends Mailable
{
  use Queueable, SerializesModels;

  public $email, $pword, $user;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($email, $pword, $user)
  {
    $this->email = $email;
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
    return $this->subject('Reach Account Activation')->view('account_activation.account_activation_message')->with(['email' => $this->email, 'pword' => $this->pword, 'user' => $this->user]);
  }
}
