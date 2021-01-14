<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Master\Undangan\ListUndanganController;
use App\Http\Controllers\Master\UndanganController as MasterUndanganController;
use App\Http\Controllers\Pembayaran\BayarUndanganController;
use App\Http\Controllers\Pembayaran\Undangan\InvoiceController;
use App\Http\Controllers\Pesanan\fotopengantin\BayarPesananFotoPengantinController;
use App\Http\Controllers\Pesanan\fotopengantin\InvoicePesananFotoPengantinController;
use App\Http\Controllers\Pesanan\FotoPengantin\ListPesananFotoPengantinController;
use App\Http\Controllers\Pesanan\FotoPengantin\TambahPesananFotoPengantinController;
use App\Http\Controllers\Pesanan\listPesananController;
use App\Http\Controllers\Pesanan\undangan\TambahPesananUndanganController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\User\dataTableUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("auth")->prefix("admin")->group(function () {
  Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");
  Route::middleware("can:Mengolah Master")->group(function () {
    Route::prefix("master")->group(function () {
      Route::prefix("undangan")->group(function () {
        Route::get("/", [MasterUndanganController::class, "index"])->name("mUndangan");
        Route::post("/tambah", [MasterUndanganController::class, "store"])->name("mUndangan.tambah");
        Route::get("/{undangan:kode_undangan}/edit", [MasterUndanganController::class, "edit"])->name("mUndangan.edit");
        Route::put("/{undangan:kode_undangan}/edit", [MasterUndanganController::class, "update"]);
        Route::delete("/{undangan:kode_undangan}/edit", [MasterUndanganController::class, "destroy"])->name("mUndangan.delete");
        Route::put("/{undangan:kode_undangan}/edit", [MasterUndanganController::class, "updateStatus"])->name("mUndangan.gantistatus");
      });
    });


    // ================ TAMBAH PESANAN ===================
    Route::prefix("tambah/pesanan")->group(function () {
      Route::get("undangan/{user?}", [TambahPesananUndanganController::class, "index"])->name("tambah.pesanan.undangan");
      Route::post("undangan/{user?}", [TambahPesananUndanganController::class, "store"]);

      Route::get("fotoPengantin/{user?}", [TambahPesananFotoPengantinController::class, "index"])->name("tambah.pesanan.foto-pengantin");
      Route::post("fotoPengantin/{user?}", [TambahPesananFotoPengantinController::class, "store"]);
    });
  });

  // ========================== PEMBAYARAN =========================
  Route::middleware("can:Menerima Pembayaran")->prefix("pembayaran")->group(function () {
    Route::get("undangan/{pesanan:no_pesanan?}", "App\Http\Controllers\Pembayaran\BayarUndanganController@index")->name("pembayaran.undangan");
    Route::post("undangan/{pesanan:no_pesanan?}", "App\Http\Controllers\Pembayaran\BayarUndanganController@update");
    Route::get("undangan/{pembayaran:no_invoice?}/invoice", [InvoiceController::class, "index"])->name("pembayaran.undangan.invoice");

    Route::get("foto-pengantin/{pesanan:no_pesanan?}", [BayarPesananFotoPengantinController::class, "index"])->name("pembayaran.foto-pengantin");
    Route::post("foto-pengantin/{pesanan:no_pesanan?}", [BayarPesananFotoPengantinController::class, "update"]);
    Route::get("foto-pengantin/{pembayaran:no_invoice?}/invoice", [InvoicePesananFotoPengantinController::class, "index"])->name("pembayaran.foto-pengantin.invoice");
  });


  // ================= PESANAN =================
  Route::middleware("can:Mengolah Pesanan")->prefix("pesanan")->group(function () {
    Route::get("undangan", [ListUndanganController::class, "index"])->name("pesanan.undangan");
    Route::get("undangan/datatable", [ListUndanganController::class, "datatable"])->name("pesanan.undangan.datatable");

    Route::get("foto-pengantin", [ListPesananFotoPengantinController::class, "index"])->name("pesanan.foto-pengantin");
    Route::get("foto-pengantin/datatable", [ListPesananFotoPengantinController::class, "datatable"])->name("pesanan.foto-pengantin.datatable");
  });
});

// =========== DATATABLE YAJRA ====================
Route::prefix("data-table")->group(function () {
  Route::get("user-pemesan", [dataTableUserController::class, "pemesan"])->name("user.pemesan");
});

// ============== SELECT 2 ================
Route::prefix("select2")->group(function () {
  Route::get("undangan", [MasterUndanganController::class, "select2"])->name("undangan.select2");
  Route::get("pesanan-undangan", [listPesananController::class, "liveSearchSelect2"])->name("pesanan.select2");

  Route::get("pesanan-foto-undangan/{status?}", [ListPesananFotoPengantinController::class, "liveSearchSelect2"])->name("pesanan.foto-pengantin.select2");
});

Route::get("test", [TestController::class, "index"])->name("test");
