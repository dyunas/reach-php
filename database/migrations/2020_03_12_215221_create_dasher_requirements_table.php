<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDasherRequirementsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dasher_requirements', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('dasher_id')->unsigned();
      $table->foreign('dasher_id')->references('id')->on('dashers');
      $table->boolean('nbiClearance');
      $table->boolean('tin');
      $table->boolean('driverLicense');
      $table->boolean('or_cr');
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
    Schema::dropIfExists('dasher_requirements');
  }
}
