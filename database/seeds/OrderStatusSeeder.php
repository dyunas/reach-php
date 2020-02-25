<?php

use App\OrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('order_statuses')->delete();

    $statuses = [
      ['status' => 'Order Placed', 'used_in' => 'merchant'],
      ['status' => 'Preparing', 'used_in' => 'merchant'],
      ['status' => 'Ready for delivery', 'used_in' => 'merchant'],
      ['status' => 'On Delivery', 'used_in' => 'Rider'],
      ['status' => 'Delivered', 'used_in' => 'Rider']
    ];

    foreach ($statuses as $status) {
      OrderStatus::create($status);
    }
  }
}
