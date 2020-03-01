<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dasher extends Model
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
   * Get the account record of the dasher.
   */
  public function user()
  {
    return $this->hasOne(User::class);
  }

  /**
   * Get the orders assigned to the dasher.
   */
  public function orders()
  {
    return $this->belongsToMany(CustomerOrder::class);
  }

  /**
   * Associate the rating with each dasher.
   */
  public function ratings()
  {
    return $this->hasMany(DasherRating::class);
  }
}
