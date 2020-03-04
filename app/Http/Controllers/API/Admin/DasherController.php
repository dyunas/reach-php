<?php

namespace App\Http\Controllers\API\Admin;

use App\Dasher;
use App\DasherRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RatingCollection as RatingCollection;

class DasherController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $startRow   = (int) $request->startrow;
    $fetchCount = (int) $request->fetchCount;
    $sortBy     = $request->sortBy;

    return Dasher::where('id', '>', $startRow)->take($fetchCount)->orderBy($sortBy)->get();
  }

  public function dasher_count()
  {
    $list = Dasher::all();

    return $list->count();
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
    $user = Dasher::find($id);
    $user->user;

    return $user;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function getDasherRating(Request $request)
  {
    return RatingCollection::collection(DasherRating::where('dasher_id', $request->id)->get());
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
