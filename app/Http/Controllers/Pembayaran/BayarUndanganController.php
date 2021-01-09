<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class BayarUndanganController extends Controller
{
  public function index(Pesanan $pesanan = null)
  {
    if ($pesanan)
      return view("Pembayaran.Undangan.no-pesanan", compact("pesanan"));
    $jumlahUndangan = Pesanan::where("status", 0)->whereHas("undangan")->count();
    if ($jumlahUndangan < 1)
      return view("Pembayaran.Undangan.kosong");
    return view("Pembayaran.Undangan.index", compact("jumlahUndangan"));
  }
  public function update(Pesanan $pesanan)
  {
    ($pesanan && $pesanan->status == 0) or abort(403, "Pesanan Tidak di temukan");
    request()->validate([
      "uang_bayar" => "required|numeric",
      "kembalian" => "required|numeric",
    ]);
    $pesanan->status = 1;
    $pesanan->update();
    $pembayaran =  $pesanan->pembayaran()->create([
      "no_invoice" => getLastId(new Pembayaran(), "no_invoice", "PBY-" . date("Ymd") . "-"),
      "jumlah_bayar" => $pesanan->jumlah_harga,
      "uang_bayar" => request("uang_bayar"),
      "kembalian" => request("uang_bayar") - $pesanan->jumlah_harga,
    ]);
    return redirect(route("pembayaran.undangan.invoice", $pembayaran->no_invoice))->with("success", "Pembayaran Berhasil di Lakukan");
  }
}
