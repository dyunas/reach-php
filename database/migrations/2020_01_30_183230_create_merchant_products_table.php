<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('merchant_products', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('merchant_id')->unsigned();
      $table->string('product_name', 100);
      $table->decimal('product_price', 10, 2);
      $table->bigInteger('category_id')->unsigned();
      $table->text('description');
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
    Schema::dropIfExists('merchant_products');
  }
}
