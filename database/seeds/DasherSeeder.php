<?php

use App\Dasher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DasherSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('dashers')->delete();

    $dashers = [
      [
        'user_id'        => 3,
        'fname'          => 'Gerick',
        'lname'          => 'Adubal',
        'mi'             => '',
        'contact_number' => '9001234567',
        'vehicle_rank'   => 'rider',
        'account_status' => 'active'
      ],
      [
        'user_id'        => 6,
        'fname'          => 'Argie',
        'lname'          => 'Cabrales',
        'mi'             => '',
        'contact_number' => '9989876543',
        'vehicle_rank'   => 'rider',
        'account_status' => 'active'
      ]
    ];

    foreach ($dashers as $dasher) {
      Dasher::create($dashers);
    }
  }
}
