<?php

namespace App\Http\Controllers\Master\Undangan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Undangan;
use Yajra\DataTables\Facades\DataTables;

class ListUndanganController extends Controller
{
  public function index()
  {
    return view("Pesanan.Undangan.list");
  }
  public function datatable()
  {
    $model = Pesanan::query();
    return DataTables::of($model)
      ->filter(function ($query) {
        $query->where("model_type", Undangan::class);
        $query->with("pembayaran");
        if (request()->has('search') && request('search')['value']) {
          $query->where('no_pesanan', 'like', '%' . request('search')['value'] . '%');
          $query->orWhereHas('pelanggan', function ($query) {
            $query->where('kode_pelanggan', 'like', '%' . request('search')['value'] . '%');
            $query->orWhere('alamat', 'like', '%' . request('search')['value'] . '%');
            $query->orWhere('no_hp', 'like', '%' . request('search')['value'] . '%');
            $query->orWhereHas('user', function ($q) {
              $q->where('name', 'like', '%' . request('search')['value'] . '%');
              $q->orWhere('email', 'like', '%' . request('search')['value'] . '%');
              return $q;
            });
            return $query;
          });
        }
      })
      ->make(true);
  }
}
