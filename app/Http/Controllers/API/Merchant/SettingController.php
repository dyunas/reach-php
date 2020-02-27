<?php

namespace App\Http\Controllers\API\Merchant;

use App\User;
use App\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
  /**
   * Display the authenticated user.
   *
   * @return \Illuminate\Http\Response
   */
  public function getAuthenticatedUser()
  {
    $user = Auth::user();
    $user->merchant;

    return $user;
  }

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
    User::where('id', Auth::user()->id)
      ->update(['email' => $request->data['email']]);

    Merchant::where('id', $id)
      ->update([
        'merchant_name' => $request->data['merchantName'],
        'location' => $request->data['location'],
        'latitude' => $request->data['lat'],
        'longitude' => $request->data['long'],
        'opening' => $request->data['openingTime'],
        'closing' => $request->data['closingTime'],
        'contact_num' => $request->data['contactNumber'],
      ]);

    $user = Auth::user();
    $user->merchant;

    return $user;
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
