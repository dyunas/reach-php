<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomerOrdersAddColumnForeignKey extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('customer_orders', function (Blueprint $table) {
      $table->bigInteger('dasher_id')->after('merchant_id')->unsigned();
      $table->boolean('opened')->after('paymentMode')->default(1);
      $table->foreign('dasher_id')->references('id')->on('dashers');
      $table->foreign('merchant_id')->references('id')->on('merchants');
      $table->foreign('customer_id')->references('id')->on('customers');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('customer_orders', function (Blueprint $table) {
      $table->dropColumn('dasher_id');
      $table->dropColumn('opened');
      $table->dropForeign('dasher_id');
      $table->dropForeign('merchant_id');
      $table->dropForeign('customer_id');
    });
  }
}
