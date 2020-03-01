<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDasherRatingsTableAddForeignKey extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('dasher_ratings', function (Blueprint $table) {
      $table->foreign('customer_id')->references('id')->on('customers');
      $table->foreign('dasher_id')->references('id')->on('dashers');
      $table->foreign('order_id')->references('id')->on('customer_orders');
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
      $table->dropForeign('customer_id');
      $table->dropForeign('dasher_id');
      $table->dropForeign('order_id');
    });
  }
}
