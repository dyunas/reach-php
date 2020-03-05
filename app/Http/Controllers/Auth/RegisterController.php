<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use Twilio\Rest\Client;
use App\EmailVerification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\EmailVerificationMailable;

class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
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
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(Request $request)
  {
    return $request->validate([
      'email'          => 'required|email',
      'password'       => 'required|string|confirmed',
      'fname'          => 'required|string',
      'lname'          => 'required|string',
      'contact_number' => 'required|digits'
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $request
   * @return \App\User
   */
  public function create(Request $request)
  {
    $token = Hash::make($request->email . '-' . now());

    $user = User::create([
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'account_type' => $request->account_type
    ]);

    if ($request->account_type == "customer") {
      Customer::create([
        'user_id' => $user->id,
        'fname' => $request->fname,
        'lname' => $request->lname,
        'contact_number' => $request->cnum,
        'account_status' => 'disabled'
      ]);
    }

    EmailVerification::create([
      'user_id' => $user->id,
      'token' => $token
    ]);

    // Mail::to($request->email)->send(new EmailVerificationMailable($token, $user->id));

    $recipients = '+63' . $request->cnum;
    $message = 'Almost there! To activate your account, Go to this link http://reachproject.s3-website.ap-east-1.amazonaws.com/#/validation/' . $user->id . '/' . $token;

    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_number = getenv("TWILIO_NUMBER");
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
      $recipients,
      ['from' => $twilio_number, 'body' => $message]
    );

    return response()->json([], 200);
  }

  public function checkEmail(Request $request)
  {
    return User::where('email', $request->email)->get();
  }

  public function verifyRegistration(Request $request)
  {
    $verified = EmailVerification::where('user_id', $request->id)->where('token', $request->token)->get();

    if (count($verified) < 1) {
      return response()->json(['header' => 'Ooops!', 'message' => 'Invalid verification token!'], 200);
    }

    User::where('id', $request->id)->update(['email_verified_at' => now()]);
    Customer::where('user_id', $request->id)->update(['account_status' => 'active']);

    return response()->json(['header' => 'Congratulations!', 'message' => 'You have successfully verified your account!'], 200);
  }
}
