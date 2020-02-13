<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * Get the items associated with the order.
   */
  public function items()
  {
    return $this->hasOne(OrderItemDetails::class);
  }
}
