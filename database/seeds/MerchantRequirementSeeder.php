<?php

use App\MerchantRequirement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerchantRequirementSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('merchant_requirements')->delete();

    $merchants = [
      [
        'merchant_id' => 1,
        'dtiSec' => 1,
        'leaseTitle' => 1,
        'busPerm' => 1,
        'brgyClearance' => 1
      ],
      [
        'merchant_id' => 2,
        'dtiSec' => 1,
        'leaseTitle' => 1,
        'busPerm' => 1,
        'brgyClearance' => 1
      ]
    ];

    foreach ($merchants as $merchant) {
      MerchantRequirement::create($merchant);
    }
  }
}
