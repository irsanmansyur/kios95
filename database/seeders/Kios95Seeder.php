<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Kios95Seeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $rPemesan = Role::create(['name' => "pelanggan"]);
    $mMaster  = Menu::create([
      "name" => "Master"
    ]);
    $pMaster  = Permission::create([
      'name' => "Mengolah Master"
    ]);
    $mMaster->navigations()->create([
      "name" => "Undangan",
      "url" => "admin/master/undangan",
      "permission_name" => $pMaster->name,
      "sequence_number" => 3,
    ]);
    $mMaster->navigations()->create([
      "name" => "Foto Pengantin",
      "url" => "admin/master/foto-pengantin",
      "permission_name" => $pMaster->name,
      "sequence_number" => 4,
    ]);


    $mTambah = Menu::create([
      "name" => "Tambah"
    ]);
    $pPelanggan  = Permission::create([
      'name' => "Menambah Pesanan"
    ]);
    $mTambah->navigations()->create([
      "name" => "Pesanan Undangan",
      "route" => "tambah.pesanan.undangan",
      "permission_name" => $pPelanggan->name,
      "sequence_number" => 4,
    ]);
    $mTambah->navigations()->create([
      "name" => "Foto Pengantin",
      "route" => "tambah.pesanan.foto-pengantin",
      "permission_name" => $pPelanggan->name,
      "sequence_number" => 4,
    ]);
    $mPembayaran = Menu::create(["name" => "Pembayaran"]);
    $pMenerimaPembayaran =  Permission::create([
      'name' => "Menerima Pembayaran"
    ]);
    $mPembayaran->navigations()->create([
      "name" => "Pesanan Undangan",
      "route" => "pembayaran.undangan",
      "permission_name" => $pMenerimaPembayaran->name,
      "sequence_number" => 1,
    ]);
    $mPesanan = Menu::create([
      "name" => "Pesanan"
    ]);
    $permission = Permission::create([
      'name' => "Mengolah Pesanan"
    ]);
    $mPesanan->navigations()->create([
      "name" => "Undangan",
      "route" => "pesanan.undangan",
      "permission_name" => $pMenerimaPembayaran->name,
      "sequence_number" => 1,
    ]);
    $mPesanan->navigations()->create([
      "name" => "Foto Pengantin",
      "route" => "pesanan.foto-pengantin",
      "permission_name" => $pMenerimaPembayaran->name,
      "sequence_number" => 2,
    ]);
  }
}
