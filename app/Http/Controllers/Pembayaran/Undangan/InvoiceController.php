<?php

namespace App\Http\Controllers\Pembayaran\Undangan;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
  public function index(Pembayaran $pembayaran = null)
  {
    ($pembayaran) or abort(403, "Pembayaran/Pesanan Tidak Di  Temukan");
    return view("Pembayaran.Undangan.invoice", compact("pembayaran"));
  }
}
