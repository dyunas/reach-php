<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  protected function formValidator($request)
  {
    return $request->validate([
      'data.email'    => 'required|email',
      'data.password' => 'required|string'
    ]);
  }

  protected function generateAccessToken($user)
  {
    return $user->createToken($user->email . '-' . now())->accessToken;
  }

  public function login(Request $request)
  {
    $this->formValidator($request);

    $user = User::where('email', $request->data['email'])->first();

    if (!$user) {
      return response()->json(["message" => "User does not exist"], 401);
    }

    if (!Hash::check($request->data['password'], $user->password)) {
      return response()->json(["message" => "Incorrect password"], 401);
    }

    $token = $this->generateAccessToken($user);

    switch ($user->account_type) {
      case 'admin':
        $owner = 'admin';
        $owner_id = $user->id;
        break;
      case 'merchant':
        $owner = $user->merchant->merchant_name;
        $owner_id = $user->merchant->id;
        break;

      case 'customer':
        $owner = $user->customer->fname . ' ' . $user->customer->lname;
        $owner_id = $user->customer->id;
        break;

      case 'dasher':
        $owner = $user->dasher->fname . ' ' . $user->dasher->lname;
        $owner_id = $user->dasher->id;
        break;

      default:
        break;
    }

    return response()->json([
      'token'        => $token,
      'account_type' => $user->account_type,
      'owner'        => $owner,
      'owner_id'     => $owner_id
    ]);
  }
}
