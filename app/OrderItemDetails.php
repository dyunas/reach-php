<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItemDetails extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * Get the order details asssociated with the item.
   */
  public function order()
  {
    return $this->belongsTo(CustomerOrder::class, 'order_id');
  }

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;
}
