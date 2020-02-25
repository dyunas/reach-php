<?php

namespace App\Http\Controllers\API\Dasher;

use App\CustomerOrder;
use App\DasherStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
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
    $row = DasherStatus::where('dasher_id', Auth::user()->dasher->id)->first();

    if (!is_null($row)) {
      DasherStatus::where('dasher_id', Auth::user()->dasher->id)
        ->update([
          'latitude'   => $request->lat,
          'longitude'  => $request->long,
          'updated_at' => now()
        ]);

      return response()->json(['message' => 'updated!'], 200);
    } else {
      DasherStatus::create([
        'dasher_id'  => Auth::user()->dasher->id,
        'latitude'   => $request->lat,
        'longitude'  => $request->long,
        'updated_at' => now()
      ]);

      return response()->json(['message' => 'created!'], 200);
    }
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

  public function checkPendingDelivery()
  {
    $dasher = DasherStatus::where('dasher_id', Auth::user()->dasher->id)
      ->where('dasher_status', 0)
      ->first();

    if (!empty((array) $dasher)) {
      return CustomerOrder::where('dasher_id', $dasher->id)
        ->where('status', '!=', 'delivered')
        ->select('id', 'order_id')
        ->get();
    } else {
      return response()->json('false', 200);
    }
  }
}
