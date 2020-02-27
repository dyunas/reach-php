<?php

namespace App\Http\Controllers\API\Dasher;

use App\CustomerOrder;
use App\DasherStatus;
use App\Events\UpdateOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderCollection as OrderCollection;

class DeliveryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CustomerOrder::where('dasher_id', Auth::user()->dasher->id)->orderBy('id', 'desc')->get();
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
      CustomerOrder::where('dasher_id', Auth::user()->dasher->id)
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

    if ($request->data['status'] === 'Delivered') {
      DasherStatus::where('dasher_id', Auth::user()->dasher->id)
        ->update(['dasher_status' => 1]);
    }

    $customer = CustomerOrder::find($id);

    $notify = new \stdclass;

    $notify->from = 'dasher';
    $notify->customer = $customer->customer_id;
    $notify->merchant = $customer->merchant_id;
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
