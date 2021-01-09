<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Undangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PesananController extends Controller
{
  public function index()
  {
  }
  public function tambah($type = null, User $user = null)
  {

    if ($type === "foto-pengantin") {
    } else {
      $data = '';
    }
    return view("Pesanan.index", compact("type"));
  }
  public function store()
  {
    $attr = request()->validate([
      "name" => "required|min:3",
      "email" => "nullable|unique:users,email," . request("id_user") . ",id",
      "no_hp" => "required|numeric",
      "alamat" => "required",
      "undangan_id" => "required|exists:undangans,id",
      "kode_undangan" => "required|exists:undangans,kode_undangan",
      "jumlah_pesanan" => "required|integer",
      "harga_satuan" => "required|integer",
      "total_harga" => "required|integer"
    ]);
    if (request("id_user")) {
      $user = User::find(request("id_user"));
      $pelanggan = $user->pelanggan;
    } else {
      $user = User::create([
        "name" => $attr['name'],
        "email" => $attr['email'] ??  uniqid("user-") . "@app",
        "password" => bcrypt($attr['name']),
      ]);
      $user->assignRole("pelanggan");
      $pelanggan =  $user->pelanggan()->create([
        "kode_pelanggan" => getLastId(new Pelanggan(), "kode_pelanggan", "PLG-" . date("Ymd") . "-"),
        "no_hp" => $attr['no_hp'],
        "alamat" => $attr['alamat'],
      ]);
    }
    $pesanan =   $pelanggan->pesanans()->create([
      "no_pesanan" => getLastId(new Pesanan(), "no_pesanan", "PSN-" . date("Ymd") . "-"),
      "model_id" => $attr["undangan_id"],
      "model_type" => Undangan::class,
      "jumlah_harga" => $attr["total_harga"],
      "harga_satuan" => $attr["harga_satuan"],
      "jumlah_pesanan" => $attr["jumlah_pesanan"],
    ]);
    $pesanan->refresh();
    return view("Pesanan.invoice-pemesanan", ["pesanan" => $pesanan]);
  }
}
