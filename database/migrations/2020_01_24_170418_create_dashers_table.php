<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dashers', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('user_id')->unisgned();
      $table->string('fname', 30);
      $table->string('lname', 30);
      $table->bigInteger('contact_number')->unsigned();
      $table->string('vehicle_rank', 20);
      $table->string('account_status');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('dashers');
  }
}
