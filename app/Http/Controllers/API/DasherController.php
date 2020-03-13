<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Dasher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DasherController extends Controller
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
    $user = Auth::user();
    $user->dasher;

    return $user;
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
    try {
      Dasher::where('id', $id)->update([
        'fname' => $request->data['fname'],
        'lname' => $request->data['lname'],
        'contact_number' => $request->data['cnum']
      ]);

      $user = Auth::user();
      $user->dasher;

      return $user;
    } catch (\Throwable $error) {
      return response()->json(['message' => 'Something went wrong while updating profile. Try again', 'error' => $error], 500);
    }
  }

  public function changePassword(Request $request)
  {
    try {
      $user = Auth::user();

      if (!Hash::check($request->data['old_pword'], $user->password)) {
        return response()->json(['message' => 'The given old password is invalid. Try again'], 400);
      }

      $user->update([
        'password' => Hash::make($request->data['new_pword'])
      ]);

      return response()->json(['message' => 'Password changed successfully!'], 200);
    } catch (\Throwable $error) {
      return response()->json(['message' => 'Something went wrong while changing password. Try again', 'error' => $error], 500);
    }
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
