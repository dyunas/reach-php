<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DasherRating extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * Get the dasher associated with the rating model.
   */
  public function dasher()
  {
    return $this->belongsTo(Dasher::class);
  }

  /**
   * Get the customer associated with the rating model.
   */
  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  /**
   * Get the order associated with the rating model.
   */
  public function order()
  {
    return $this->belongsTo(CustomerOrder::class);
  }
}
