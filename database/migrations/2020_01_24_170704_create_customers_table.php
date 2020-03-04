<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('user_id')->unisgned();
      $table->string('fname', 30);
      $table->string('lname', 30);
      $table->string('mi', 2)->nullable();
      $table->bigInteger('contact_number')->unsigned();
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
    Schema::dropIfExists('customers');
  }
}
