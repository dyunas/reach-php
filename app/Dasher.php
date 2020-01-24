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
}
