<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use App\Http\Resources\PesananCollection;
use App\Models\Pesanan;

class listPesananController extends Controller
{
  public function liveSearchSelect2()
  {
    $search = request('search');
    if (!$search)
      return response()->json(new PesananCollection(Pesanan::where("status", 0)->paginate(20)));
    return response()->json(Pesanan::where("status", 0)->where(function ($query) {
      $query->whereHas('undangan', function ($query) {
        $query->where("kode_undangan", 'like', '%' . request('search') . '%');
        $query->orWhere("nama_undangan", 'like', '%' . request('search') . '%');
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
