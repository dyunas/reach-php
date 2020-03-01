<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomerOrdersAddDeliveryAndDistanceColumn extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('customer_orders', function (Blueprint $table) {
      $table->decimal('distance', 10, 2)->after('subTotal');
      $table->decimal('delivery_fee', 10, 2)->after('distance');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('dasher_ratings', function (Blueprint $table) {
      $table->dropColumn('distance');
      $table->dropColumn('delivery_fee');
    });
  }
}
