<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDasherStatusTableAddColumn extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('dasher_statuses', function (Blueprint $table) {
      $table->boolean('dasher_status')->after('dasher_id')->default(1);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('dasher_statuses', function (Blueprint $table) {
      $table->dropColumn('dasher_status');
    });
  }
}
