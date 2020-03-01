<?php

namespace App\Http\Controllers\API\Dasher;

use App\DasherRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RatingCollection as RatingCollection;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return RatingCollection::collection(DasherRating::where('dasher_id', Auth::user()->dasher->id)->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    return DasherRating::create([
      'order_id'    => $request->order_id,
      'customer_id' => $request->customer_id,
      'dasher_id'   => $request->dasher_id,
      'rating'      => $request->rating,
      'comment'     => $request->comment
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $result = DasherRating::where('order_id', $id)->get();

    if (empty($result)) {
      return response()->json([], 400);
    }

    return $result[0]->rating;
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
