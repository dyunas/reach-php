<?php

use App\MerchantRequirement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(UserSeeder::class);
    $this->call(MerchantSeeder::class);
    $this->call(CustomerSeeder::class);
    $this->call(DasherSeeder::class);
    $this->call(ProductCategorySeeder::class);
    $this->call(OrderStatusSeeder::class);
    $this->call(MerchantRequirementSeeder::class);
    $this->call(DasherRequirementSeeder::class);
  }
}
