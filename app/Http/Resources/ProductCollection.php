<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id'            => $this->id,
      'product_name'  => $this->product_name,
      'product_price' => $this->product_price,
      'category'      => $this->category->category,
    ];
  }
}
