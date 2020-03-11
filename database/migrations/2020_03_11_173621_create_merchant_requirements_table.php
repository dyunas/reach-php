<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantRequirementsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('merchant_requirements', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('merchant_id')->unsigned();
      $table->foreign('merchant_id')->references('id')->on('merchants');
      $table->boolean('dtiSec');
      $table->boolean('leaseTitle');
      $table->boolean('busPerm');
      $table->boolean('brgyClearance');
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
    Schema::dropIfExists('merchant_requirements');
  }
}
