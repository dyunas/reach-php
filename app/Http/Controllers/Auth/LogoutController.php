<?php

namespace App\Http\Controllers\Auth;

use App\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
  public function logout(Request $request)
  {
    if (Auth::user()->account_type === 'merchant') {
      Merchant::where('user_id', Auth::user()->id)->update(['status' => 0]);
    }

    $request->user()->token()->revoke();

    return response()->json(["message" => "You have successfully logged out!"], 200);
  }
}
