<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * Get the account record of the customer.
   */
  public function user()
  {
    return $this->hasOne(User::class);
  }

  /**
   * Get the orders of the customer.
   */
  public function orders()
  {
    return $this->hasMany(CustomerOrder::class);
  }
}
