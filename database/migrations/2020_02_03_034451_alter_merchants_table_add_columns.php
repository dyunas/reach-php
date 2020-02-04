<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMerchantsTableAddColumns extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('merchants', function (Blueprint $table) {
      $table->string('photo')->after('user_id');
      $table->text('description')->after('location');
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
      $table->dropColumn('photo');
      $table->dropColumn('description');
    });
  }
}
