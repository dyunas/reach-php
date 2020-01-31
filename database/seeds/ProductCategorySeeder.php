<?php

use App\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('product_categories')->delete();

    $categories = [
      [
        'merchant_id' => 1,
        'category'    => 'Chickenjoy'
      ],
      [
        'merchant_id' => 1,
        'category'    => 'Yumburger'
      ]
    ];

    ProductCategory::insert($categories);
  }
}
