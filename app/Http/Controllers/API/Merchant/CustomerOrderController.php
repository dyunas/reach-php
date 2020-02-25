<?php

namespace App\Http\Controllers\API\Merchant;

use App\Dasher;
use App\DasherStatus;
use App\CustomerOrder;
use App\OrderItemDetails;
use App\Events\PlacedOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection as OrderCollection;
use App\OrderStatus;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CustomerOrder::where('dasher_id', Auth::user()->merchant->id)->get();
  }

  public function order_opened(Request $request)
  {
    return CustomerOrder::where('id', $request->data['id'])
      ->update(['opened' => 0]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return OrderCollection::collection(
      CustomerOrder::where('merchant_id', Auth::user()->merchant->id)
        ->where('id', $id)
        ->get()
    )->toJson();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    CustomerOrder::where('id', $id)
      ->update([
        'status' => $request->data['status']
      ]);

    return response()->json(['message' => 'Order Status Updated!'], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
