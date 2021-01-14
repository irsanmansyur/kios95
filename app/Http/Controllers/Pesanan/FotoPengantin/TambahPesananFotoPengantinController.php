<?php

namespace App\Http\Controllers\Pesanan\FotoPengantin;

use App\Http\Controllers\Controller;
use App\Models\FotoPengantin;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\User;

use function PHPUnit\Framework\returnSelf;

class TambahPesananFotoPengantinController extends Controller
{
  public function index(User $user)
  {
    if ($user->id && !$user->pelanggan()->exists())
      abort(403, "Please use User Pelanggan");
    return view("Pesanan.foto-pengantin.tambah", compact("user"));
  }
  public function store(User $user = null)
  {
    if ($user && !$user->pelanggan()->exists())
      abort(403, "Please use User Pelanggan");

    $attr = request()->validate([
      "lokasi" => "required|min:3",
      "jumlah_roll" => "required|integer",
      "biaya_per_roll" => "required|integer",
      "jumlah_biaya" => "required|integer",

      "name" => "required|min:3",
      "email" => "nullable|unique:users,email," . request("id_user") . ",id",
      "no_hp" => "required|numeric",
      "alamat" => "required",

    ]);

    if (request("id_user"))
      $user = User::find(request("id_user"));

    if (!$user) {
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
    $fotoPengantin = FotoPengantin::create([
      "jumlah_roll" => $attr["jumlah_roll"],
      "biaya_per_roll" => $attr["biaya_per_roll"],
      "jumlah_biaya" => $attr["jumlah_roll"] *  $attr["biaya_per_roll"],
      "lokasi" => $attr["lokasi"],
    ]);

    $pesanan =  $user->pelanggan->pesanans()->create([
      "no_pesanan" => getLastId(new Pesanan(), "no_pesanan", "PSN-" . date("Ymd") . "-"),
      "model_id" => $fotoPengantin->id,
      "model_type" => FotoPengantin::class,
      "harga_satuan" => $fotoPengantin->biaya_per_roll,
      "jumlah_pesanan" => $fotoPengantin->jumlah_roll,
      "jumlah_harga" => $fotoPengantin->jumlah_biaya,
    ]);

    $pesanan->refresh();
    return view("Pesanan.invoice-pemesanan", ["pesanan" => $pesanan]);
  }
}
