<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingCollection extends JsonResource
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
      'id'         => $this->id,
      'dasher'     => $this->dasher,
      'customer'   => $this->customer,
      'order'      => $this->order,
      'rating'     => $this->rating,
      'comment'    => $this->comment,
      'created_at' => $this->created_at
    ];
  }
}
