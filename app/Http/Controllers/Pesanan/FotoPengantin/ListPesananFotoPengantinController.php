<?php

namespace App\Http\Controllers\Pesanan\FotoPengantin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Resources\PesananCollection;
use App\Models\FotoPengantin;
use App\Models\Pesanan;
use Yajra\DataTables\Facades\DataTables;

class ListPesananFotoPengantinController extends BaseAdminController
{
  public function index()
  {
    return view("Pesanan.foto-pengantin.list");
  }
  public function datatable()
  {
    $model = Pesanan::query();
    return DataTables::of($model)
      ->filter(function ($query) {
        $query->where("model_type", FotoPengantin::class);
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
  public function liveSearchSelect2($status)
  {

    $search = request('search');
    if (!$search)
      return response()->json(new PesananCollection(Pesanan::with('fotopengantin')->where("status", 0)->where("model_type", FotoPengantin::class)->paginate(20)));
    return response()->json(Pesanan::with('fotopengantin')->where("status", 0)->where("model_type", FotoPengantin::class)->where(function ($query) {
      $query->whereHas('fotopengantin', function ($query) {
        $query->where("lokasi", 'like', '%' . request('search') . '%');
        return $query;
      });
      $query->orWhereHas('pelanggan', function ($query) {
        $query->whereHas("user", function ($user) {
          $user->where("name", 'like', '%' . request('search') . '%');
          $user->orWhere("email", 'like', '%' . request('search') . '%');
          return $user;
        });
        $query->orWhere("kode_pelanggan", 'like', '%' . request('search') . '%');
        $query->orWhere("alamat", 'like', '%' . request('search') . '%');
        return $query;
      });
      $query->orWhere('no_pesanan', 'like', '%' . request('search') . '%');
      return $query;
    })->paginate(20));
  }
}
