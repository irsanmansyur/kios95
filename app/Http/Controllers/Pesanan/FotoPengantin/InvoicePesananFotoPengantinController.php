<?php

namespace App\Http\Controllers\Pesanan\fotopengantin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class InvoicePesananFotoPengantinController extends Controller
{
  public function index(Pembayaran $pembayaran = null)
  {
    ($pembayaran) or abort(403, "Pembayaran/Pesanan Tidak Di  Temukan");
    return view("Pembayaran.foto-pengantin.invoice", compact("pembayaran"));
  }
}
