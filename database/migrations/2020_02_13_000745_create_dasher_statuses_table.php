<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDasherStatusesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dasher_statuses', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('dasher_id')->unsigned();
      $table->double('latitude');
      $table->double('longitude');
      $table->timestamp('updated_at', 0);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('dasher_statuses');
  }
}
