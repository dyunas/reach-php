<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderCollection extends JsonResource
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
      'order_id'      => $this->order_id,
      'customer'      => $this->customer,
      'merchant'      => $this->merchant,
      'rider'         => $this->dasher,
      'status'        => $this->status,
      'custLat'       => $this->custLat,
      'custLong'      => $this->custLong,
      'merchLat'      => $this->merchLat,
      'merchLong'     => $this->merchLong,
      'location'      => $this->location,
      'items'         => $this->items,
      'instruction'   => $this->instruction,
      'subTotal'      => $this->subTotal,
      'total'         => $this->total,
      'paymentMode'   => $this->paymentMode,
      'created_at'    => $this->created_at,
      'updated_at'    => $this->updated_at
    ];
  }
}
