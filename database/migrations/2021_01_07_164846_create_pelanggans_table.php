<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pelanggans', function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id");
      $table->string("kode_pelanggan");
      $table->string("alamat");
      $table->string("no_hp");
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
    Schema::dropIfExists('pelanggans');
  }
}
