<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDasherRatingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dasher_ratings', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('customer_id')->unsigned();
      $table->bigInteger('dasher_id')->unsigned();
      $table->bigInteger('order_id')->unsigned();
      $table->tinyInteger('rating')->unsigned();
      $table->text('comment');
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
    Schema::dropIfExists('dasher_ratings');
  }
}
