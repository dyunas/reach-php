<?php

namespace App\Http\Controllers\API\Admin;

use App\User;
use App\Merchant;
use App\MerchantRequirement;
use App\Http\Controllers\Controller;
use App\Mail\AccountActivationMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MerchantController extends Controller
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

    return Merchant::where('id', '>', $startRow)->take($fetchCount)->orderBy($sortBy)->get();
  }

  public function merchant_count()
  {
    $list = Merchant::all();

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
        'account_type' => 'merchant'
      ]);

      $merchant = Merchant::create([
        'user_id'        => $user->id,
        'photo'          => '',
        'merchant_name'  => $request->merchantName,
        'location'       => '',
        'description'    => '',
        'contact_num'    => $request->contactNumber,
        'account_status' => 'pending'
      ]);

      MerchantRequirement::create([
        'merchant_id' => $merchant->id,
        'dtiSec' => $request->brgyClearance,
        'leaseTitle' => $request->busPerm,
        'busPerm' => $request->dtiSec,
        'brgyClearance' => $request->leaseTitle
      ]);

      return response()->json(['message' => 'Merchant created succesfully'], 201);
    } catch (\Throwable $error) {
      return response()->json([
        'message' => 'Something went wrong while creating merchant. Please try again.',
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
    $merchant = Merchant::find($id);
    $merchant->user;
    $merchant->requirements;

    return $merchant;
  }

  public function update_account_status(Request $request, $id)
  {
    $status = ($request->data['status'] == 'pending' || $request->data['status'] == 'deactivated') ? 'active' : 'deactivated';
    $merchant = Merchant::find($id);
    $merchant->update([
      'account_status' => $status
    ]);

    if ($request->data['status'] == 'pending') {
      $date = date('ymd');
      $pword = 'reach' . $date;
      $pwordHashed = Hash::make($pword);
      User::where('id', $merchant->user_id)->update([
        'email_verified_at' => now(),
        'password' => $pwordHashed
      ]);

      Mail::to($merchant->user->email)->send(new AccountActivationMailable($merchant->user->email, $pword, $merchant->merchant_name));

      return response()->json(['message' => 'account has been activated']);
    }

    if ($request->status == 'active') {
      return response()->json(['message' => 'account has been deactivated']);
    }

    return response()->json(['message' => 'account has been activated']);
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
