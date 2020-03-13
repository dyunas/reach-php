<?php

use App\DasherRequirement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DasherRequirementSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('dasher_requirements')->delete();

    $requirements = [
      [
        'dasher_id' => 1,
        'nbiClearance' => 1,
        'tin' => 1,
        'driverLicense' => 1,
        'or_cr' => 1,
      ],
      [
        'dasher_id' => 2,
        'nbiClearance' => 1,
        'tin' => 1,
        'driverLicense' => 1,
        'or_cr' => 1,
      ]
    ];

    foreach ($requirements as $requirement) {
      DasherRequirement::create($requirement);
    }
  }
}
