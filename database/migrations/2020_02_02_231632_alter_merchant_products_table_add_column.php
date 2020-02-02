<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMerchantProductsTableAddColumn extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('merchant_products', function (Blueprint $table) {
      $table->string('avatar')->after('merchant_id');
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
      $table->dropColumn('avatar');
    });
  }
}
