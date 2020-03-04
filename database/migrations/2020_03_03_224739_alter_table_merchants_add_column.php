<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMerchantsAddColumn extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('merchants', function (Blueprint $table) {
      $table->boolean('status')->default(0)->after('closing');
      $table->string('account_status', 10)->after('status');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('merchants', function (Blueprint $table) {
      $table->dropColumn('status');
      $table->dropColumn('account_status');
    });
  }
}
