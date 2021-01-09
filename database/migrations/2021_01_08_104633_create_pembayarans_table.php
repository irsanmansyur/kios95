<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pembayarans', function (Blueprint $table) {
      $table->id();
      $table->string("no_invoice")->unique();
      $table->foreignId("pesanan_id");
      $table->integer("jumlah_bayar");
      $table->integer("kembalian");
      $table->integer("uang_bayar");
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
    Schema::dropIfExists('pembayarans');
  }
}
