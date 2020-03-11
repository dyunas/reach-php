<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
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
   * Get the account record of the merchant.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the order for each merchant.
   */
  public function orders()
  {
    return $this->hasMany(User::class);
  }

  public function requirements()
  {
    return $this->hasOne(MerchantRequirement::class);
  }
}
