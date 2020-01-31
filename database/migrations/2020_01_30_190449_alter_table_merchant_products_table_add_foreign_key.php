<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMerchantProductsTableAddForeignKey extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('merchant_products', function (Blueprint $table) {
      $table->foreign('merchant_id')->references('id')->on('merchants');
      $table->foreign('category_id')->references('id')->on('product_categories');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('merchant_products', function (Blueprint $table) {
      $table->dropForeign('merchant_id');
      $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');

      $table->dropForeign('category_id');
      $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
    });
  }
}
