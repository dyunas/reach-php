<?php

namespace App\Http\Controllers\API\Customer;

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

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CustomerOrder::where('customer_id', Auth::user()->customer->id)->orderBy('id', 'desc')->get();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rider = DB::select(
      "SELECT *, (SELECT round(
          (
            (
              acos(
                sin(( $request->merchLat * pi() / 180))
                *
                sin(( latitude * pi() / 180)) + cos(( $request->merchLat * pi() /180 ))
                *
                cos(( latitude * pi() / 180)) * cos((( $request->merchLong - longitude) * pi()/180)))
            ) * 180/pi()
          ) * 60 * 1.1515 * 1.609344
        , 2) as distance
        FROM dasher_statuses
        HAVING distance <= 5
        LIMIT 1) as distance
        FROM dasher_statuses
        WHERE unix_timestamp() - unix_timestamp(updated_at) < 5
        AND dasher_status = 1
        ORDER BY distance"
    );

    if (empty($rider)) {
      return response()->json(['header' => 'Oh no!', 'message' => 'There is no available rider at this moment. Pleast try again later!', 'ok' => false], 201);
    }

    DasherStatus::where('dasher_id', $rider[0]->id)->update(['dasher_status' => 0]);

    $order_details = $this->store_order($request, $rider[0]->id);
    $order_item = $this->store_order_items($request->cart, $order_details->id);

    $notify = new \stdclass;

    $notify->merchant_id = $order_details->merchant_id;
    $notify->rider_id = $rider[0]->id;
    $notify->type = 'new order';
    $notify->message = 'Order Ready! Click here';
    $notify->path = $order_details->id;

    event(new PlacedOrder($notify));

    return response()->json(['header' => 'Order Placed!', 'message' => 'Your order has been placed!', 'order_id' => $order_details->id, 'ok' => true], 201);
  }

  public function store_order($request, $rider_id)
  {
    $now = date('Ymd');
    $uniq = substr(uniqid(mt_rand(), true), 0, 5);

    return CustomerOrder::create([
      'order_id'    => 'CR-' . $now . '-' . $uniq,
      'customer_id' => $request->customerID,
      'merchant_id' => $request->merchantID,
      'dasher_id'   => $rider_id,
      'status'      => 'Order placed',
      'custLat'     => $request->custLat,
      'custLong'    => $request->custLong,
      'merchLat'    => $request->merchLat,
      'merchLong'   => $request->merchLong,
      'location'    => $request->location,
      'instruction' => $request->instruction,
      'subTotal'    => $request->subTotal,
      'total'       => $request->total,
      'paymentMode' => $request->paymentMode,
      'opened'      => 1
    ]);
  }

  public function store_order_items($cart, $orderid)
  {
    $items = [];

    foreach ($cart as $item) {
      $items[] = [
        'prod_id'  => $item['id'],
        'order_id' => $orderid,
        'name'     => $item['name'],
        'qty'      => $item['qty'],
        'price'    => $item['price']
      ];
    }

    return OrderItemDetails::insert($items);
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
      CustomerOrder::where('customer_id', Auth::user()->customer->id)
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
