<?php

namespace App\Http\Controllers\API\Customer;

use App\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $stores = DB::table('merchants')
      ->selectRaw('
              *, 
              round(
                (
                  (
                    acos(
                      sin(( ' . $request->custLat . ' * pi() / 180))
                      *
                      sin(( latitude * pi() / 180)) + cos(( ' . $request->custLat . ' * pi() /180 ))
                      *
                      cos(( latitude * pi() / 180)) * cos((( ' . $request->custLong . ' - longitude) * pi()/180)))
                  ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
              , 2) as distance
            ')
      ->havingRaw('distance <= 5')
      ->limit(15)
      ->get();

    return $stores;
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
