<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantRequirement extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  public function merchant()
  {
    return $this->belongsTo(Merchant::class);
  }
}
