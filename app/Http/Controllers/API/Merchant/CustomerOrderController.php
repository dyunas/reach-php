<?php

namespace App\Http\Controllers\API\Merchant;

use App\CustomerOrder;
use App\Events\UpdateOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderCollection as OrderCollection;

class CustomerOrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CustomerOrder::where('merchant_id', Auth::user()->merchant->id)->orderBy('id', 'desc')->get();
  }

  public function order_opened(Request $request)
  {
    return CustomerOrder::where('id', $request->id)
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

    $customer = CustomerOrder::find($id);

    $notify = new \stdclass;

    $notify->from = 'merchant';
    $notify->customer = $customer->customer_id;
    $notify->customer = $customer->customer_id;
    $notify->rider = $customer->dasher_id;
    $notify->header = $customer->order_id;
    $notify->message = $customer->status;
    $notify->date = $customer->updated_at;
    $notify->path = $customer->id;

    event(new UpdateOrder($notify));

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
