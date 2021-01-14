<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoPengantinsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('foto_pengantins', function (Blueprint $table) {
      $table->id();
      $table->integer("jumlah_roll");
      $table->string("lokasi");
      $table->integer("biaya_per_roll");
      $table->integer("jumlah_biaya");
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
    Schema::dropIfExists('foto_pengantins');
  }
}
