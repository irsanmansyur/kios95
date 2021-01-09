<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\DataTables;


class dataTableUserController extends Controller
{
  public function pemesan()
  {
    $model = User::query()->with("pelanggan")->role("pelanggan");

    return DataTables::of($model)
      ->filter(function ($query) {
        if (request()->has('idSelected')) {
          $query->whereNotIn('id', explode(",", request('idSelected')));
        }
        if (request()->has('diagnosa_id')) {
          $query->whereNotIn('id', request('diagnosa_id'));
        }
        if (request()->has('search') && request('search')['value']) {
          $query->where('name', 'like', '%' . request('search')['value'] . '%');
          $query->orWhere('email', 'like', '%' . request('search')['value'] . '%');
        }
      })
      ->make(true);
  }
}
