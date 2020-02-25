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
    return $this->hasMany(OrderItemDetails::class, 'order_id', 'id');
  }

  /**
   * Get the rider assigned to the customer order.
   */
  public function dasher()
  {
    return $this->belongsTo(Dasher::class);
  }

  /**
   * Get the rider assigned to the customer order.
   */
  public function merchant()
  {
    return $this->belongsTo(Merchant::class);
  }

  /**
   * Get the customer who made the order.
   */
  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }
}
