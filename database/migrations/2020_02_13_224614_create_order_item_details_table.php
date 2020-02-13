<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_item_details', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('prod_id')->unsigned();
      $table->string('order_id', 50);
      $table->string('name', 100);
      $table->bigInteger('qty')->unsigned();
      $table->decimal('price', 10, 2);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order_item_details');
  }
}
