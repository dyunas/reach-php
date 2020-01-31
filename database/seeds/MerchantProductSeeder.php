<?php

use App\MerchantProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerchantProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('merchant_products')->delete();

    MerchantProduct::create([
      'merchant_id'  => 1,
      'product_name' => 'Chicken Joy',
      'product_price' => 110.00,
      'category_id'  => 1,
      'description'  => 'Crispylicious, juicylicious, chicken joy!',
    ]);
  }
}
