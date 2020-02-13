<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\CustomerOrder;
use App\DasherStatus;
use App\Events\PlacedOrder;
use App\OrderItemDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $order_details = $this->store_order($request);
    $order_item = $this->store_order_items($request->cart, $order_details->id);

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
        ORDER BY distance"
    );


    $notify = new \stdclass;

    $notify->rider_id = $rider[0]->id;
    $notify->type = 'new order';
    $notify->message = 'Order Ready! Click here';
    $notify->path = '/dasher/my_deliveries/' . $order_details->id;

    event(new PlacedOrder($notify));

    return response()->json(['header' => 'Order Placed!', 'message' => 'Your order has been placed!'], 201);
  }

  public function store_order($request)
  {
    $now = date('Ymd');
    $uniq = substr(uniqid(mt_rand(), true), 0, 5);

    return CustomerOrder::create([
      'order_id'    => 'CR-' . $now . '-' . $uniq,
      'customer_id' => $request->customerID,
      'merchant_id' => $request->merchantID,
      'status'      => 'Order placed',
      'custLat'     => $request->custLat,
      'custLong'    => $request->custLong,
      'merchLat'    => $request->merchLat,
      'merchLong'   => $request->merchLong,
      'location'    => $request->location,
      'subTotal'    => $request->subTotal,
      'total'       => $request->total,
      'paymentMode' => $request->paymentMode
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
    //
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
    //
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
