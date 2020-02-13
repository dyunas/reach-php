<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customer_orders', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('order_id')->unique();
      $table->bigInteger('customer_id')->unsigned();
      $table->bigInteger('merchant_id')->unsigned();
      $table->string('status', 30);
      $table->double('custLat');
      $table->double('custLong');
      $table->double('merchLat');
      $table->double('merchLong');
      $table->text('location');
      $table->decimal('subTotal', 10, 2);
      $table->decimal('total', 10, 2);
      $table->string('paymentMode', 30);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('customer_orders');
  }
}
