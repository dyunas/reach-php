<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DasherRequirement extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  public function dasher()
  {
    return $this->belongsTo(Dasher::class);
  }
}
