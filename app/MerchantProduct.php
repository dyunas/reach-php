<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantProduct extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * Get the category associated with the product.
   */
  public function category()
  {
    return $this->belongsTo(ProductCategory::class);
  }
}
