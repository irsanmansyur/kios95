<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\admin\UndanganController;
use App\Http\Controllers\Master\Undangan\ListUndanganController;
use App\Http\Controllers\Master\UndanganController as MasterUndanganController;
use App\Http\Controllers\Pembayaran\BayarUndanganController;
use App\Http\Controllers\Pembayaran\Undangan\InvoiceController;
use App\Http\Controllers\Pesanan\listPesananController;
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

    Route::prefix("tambah")->group(function () {
      Route::get("pesanan/{type?}/{user?}", [PesananController::class, "tambah"])->name("tambah.pesanan");
      Route::post("pesanan/{type?}/{user?}", [PesananController::class, "store"]);
    });
  });
  Route::middleware("can:Menerima Pembayaran")->prefix("pembayaran")->group(function () {
    Route::get("undangan/{pesanan:no_pesanan?}", "App\Http\Controllers\Pembayaran\BayarUndanganController@index")->name("pembayaran.undangan");
    Route::post("undangan/{pesanan:no_pesanan?}", "App\Http\Controllers\Pembayaran\BayarUndanganController@update");
    Route::get("undangan/{pembayaran:no_invoice?}/invoice", [InvoiceController::class, "index"])->name("pembayaran.undangan.invoice");
  });
  Route::middleware("can:Mengolah Pesanan")->prefix("pesanan")->group(function () {
    Route::get("undangan", [ListUndanganController::class, "index"])->name("pesanan.undangan");
    Route::get("undangan/datatable", [ListUndanganController::class, "datatable"])->name("pesanan.undangan.datatable");
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
});

Route::get("test", [TestController::class, "index"])->name("test");
