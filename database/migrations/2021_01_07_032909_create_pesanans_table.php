<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pesanans', function (Blueprint $table) {
      $table->id();
      $table->string("no_pesanan")->unique();
      $table->foreignId("pelanggan_id");
      $table->string("model_type");
      $table->foreignId("model_id");
      $table->integer("jumlah_pesanan");
      $table->integer("harga_satuan");
      $table->integer("jumlah_harga");
      $table->integer("status")->default(0)->comment("0  : Belum Bayar , 1 :Dibayar, 2 : barang diambil dan dibayar");
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
    Schema::dropIfExists('pesanans');
  }
}
