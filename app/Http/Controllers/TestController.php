<?php

namespace App\Http\Controllers;

use App\Http\Resources\PesananCollection;
use App\Http\Resources\PesananResource;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class TestController extends Controller
{
  public function index()
  {
    // return  new PesananResource(Pesanan::findOrFail(1));
    return  new PesananCollection(Pesanan::paginate(20));
    return  PesananCollection::collection(Pesanan::paginate(20));
  }
}
