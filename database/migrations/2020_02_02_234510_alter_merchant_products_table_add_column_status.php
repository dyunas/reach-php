<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMerchantProductsTableAddColumnStatus extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('merchant_products', function (Blueprint $table) {
      $table->string('status', 20)->after('category_id');
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
      $table->dropColumn('status');
    });
  }
}
