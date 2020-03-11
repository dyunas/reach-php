<?php

use App\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('customers')->delete();

    Customer::create(
      [
        'user_id'        => 4,
        'fname'          => 'Ariana Lexis',
        'lname'          => 'Gonzales',
        'contact_number' => '9001234567',
        'account_status' => 'active'
      ]
    );
  }
}
