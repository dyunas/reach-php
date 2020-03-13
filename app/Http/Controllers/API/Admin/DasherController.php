<?php

namespace App\Http\Controllers\API\Admin;

use App\User;
use App\Dasher;
use App\DasherRating;
use App\DasherRequirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivationMailable;
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
    try {
      $user = User::create([
        'email'        => $request->email,
        'account_type' => 'dasher'
      ]);

      $dasher = Dasher::create([
        'user_id'        => $user->id,
        'fname'          => $request->fname,
        'lname'          => $request->lname,
        'contact_number' => $request->contactNumber,
        'vehicle_rank'   => 'rider',
        'account_status' => 'pending'
      ]);

      DasherRequirement::create([
        'dasher_id' => $dasher->id,
        'nbiClearance' => $request->nbiClearance,
        'tin' => $request->tin,
        'driverLicense' => $request->driverLicense,
        'or_cr' => $request->or_cr
      ]);

      return response()->json(['message' => 'Dasher created succesfully'], 201);
    } catch (\Throwable $error) {
      return response()->json([
        'message' => 'Something went wrong while creating dasher. Please try again.',
        'error' => $error
      ], 400);
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
    $dasher = Dasher::find($id);
    $dasher->user;
    $dasher->requirements;

    return $dasher;
  }

  public function update_account_status(Request $request, $id)
  {
    try {
      $status = ($request->data['status'] == 'pending' || $request->data['status'] == 'deactivated') ? 'active' : 'deactivated';
      $dasher = Dasher::find($id);
      $dasher->update([
        'account_status' => $status
      ]);

      if ($request->data['status'] == 'pending') {
        $date = date('ymd');
        $pword = 'reach' . $date;
        $pwordHashed = Hash::make($pword);
        User::where('id', $dasher->user_id)->update([
          'email_verified_at' => now(),
          'password' => $pwordHashed
        ]);

        Mail::to($dasher->user->email)->send(new AccountActivationMailable($dasher->user->email, $pword, $dasher->fname));

        return response()->json(['message' => 'account has been activated']);
      }

      if ($request->status == 'active') {
        return response()->json(['message' => 'account has been deactivated']);
      }

      return response()->json(['message' => 'account has been activated']);
    } catch (\Throwable $error) {
      return response()->json(['message' => 'something went wrong while updating dasher status. try again', 'error' => $error], 500);
    }
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
