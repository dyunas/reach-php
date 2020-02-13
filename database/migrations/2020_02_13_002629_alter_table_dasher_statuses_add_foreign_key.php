<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDasherStatusesAddForeignKey extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('dasher_statuses', function (Blueprint $table) {
      $table->foreign('dasher_id')->references('id')->on('dashers');
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
      $table->dropForeign('dasher_id');
      $table->foreign('dasher_id')->references('id')->on('dashers')->onDelete('cascade');
    });
  }
}
