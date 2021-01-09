<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUndanganUserTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('undangan_user', function (Blueprint $table) {
      $table->id();
      $table->foreignId("undangan_id");
      $table->foreignId("user_id");
      $table->integer("jumlah_pesanan");
      $table->integer("harga_satuan");
      $table->integer("jumlah_harga");
      $table->integer("status")->default(0)->comment("0 : Belum Bayar ; 1 : Sudah Di bayar ; 2 : Sudah di ambil dan Dibayar");
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
    Schema::dropIfExists('undangan_user');
  }
}
