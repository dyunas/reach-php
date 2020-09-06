<?php

namespace App\Http\Controllers\API\Merchant;

use App\User;
use App\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

	public function changeBanner(Request $request)
	{
		Merchant::where('user_id', Auth::user()->id)
			->update(['photo' => $request->banner->store('uploads', 'public')]);

		return Merchant::where('user_id', Auth::user()->id)->select('photo')->get();
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
		Merchant::where('id', $id)
			->update([
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

	public function changePassword(Request $request)
	{
		$user = Auth::user();

		if (!Hash::check($request->data['old_pword'], $user->password)) {
			return response()->json(['message' => 'The given old password is invalid. Try again'], 400);
		}

		$user->update([
			'password' => Hash::make($request->data['new_pword'])
		]);

		return response()->json(['message' => 'Password changed successfully!'], 200);
	}

	public function merchant_check_status()
	{
		try {
			return Merchant::where('user_id', Auth::user()->merchant->user_id)->select('status')->get();
		} catch (\Throwable $error) {
			return response()->json(['message' => 'Something went wrong while getting status. Please try again', 'error' => $error], 500);
		}
	}

	public function merchant_update_status(Request $request)
	{
		try {
			$merchant = Merchant::where('user_id', Auth::user()->merchant->user_id)->update([
				'status' => $request->data['status']
			]);

			return Merchant::where('user_id', Auth::user()->merchant->user_id)->select('status')->get();
		} catch (\Throwable $error) {
			return response()->json(['message' => 'Something went wrong while updating status. Please try again', 'error' => $error], 500);
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
