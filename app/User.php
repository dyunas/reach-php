<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get the merchant record associated with the user.
   */
  public function merchant()
  {
    return $this->hasOne(Merchant::class);
  }

  /**
   * Get the customer record associated with the user.
   */
  public function customer()
  {
    return $this->hasOne(Customer::class);
  }

  /**
   * Get the dasher record associated with the user.
   */
  public function dasher()
  {
    return $this->hasOne(Dasher::class);
  }
}
