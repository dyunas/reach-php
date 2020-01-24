<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
  public function logout(Request $request)
  {
    $request->user()->token()->revoke();

    return response()->json(["message" => "You have successfully logged out!"], 200);
  }
}
