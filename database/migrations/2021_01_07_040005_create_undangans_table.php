<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

class CreateUndangansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('undangans', function (Blueprint $table) {
      $table->id();
      $table->string("kode_undangan")->unique();
      $table->string("nama_undangan");
      $table->integer("harga_beli");
      $table->integer("harga_jual");
      $table->integer("stock");
      $table->integer("status")->default(0);
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
    Schema::dropIfExists('undangans');
  }
}
