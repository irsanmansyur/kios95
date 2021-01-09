<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FotoPengantin;
use App\Models\Pesanan;
use App\Models\Undangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view("Dashboard.index", [
      "dataDoughnut" => json_encode($this->dataDoughnut()),
      "chartPesanan" => json_encode($this->dataYearsPesanan()),
      "jumlahPesananUndangan" => Pesanan::where("model_type", Undangan::class)->count(),
      "jumlahPesananFotoPengantin" => Pesanan::where("model_type", FotoPengantin::class)->count(),
      "pesananSelesai" => Pesanan::where("status", 1)->count(),
      "pesananBelumBayar" => Pesanan::where("status", 0)->count(),
    ]);
  }
  public function dataYearsPesanan()
  {
    $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    $data = [];
    foreach ($labels as $key => $i) {
      $year = date("Y");
      $undangan = Pesanan::where("model_type", Undangan::class)->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $key + 1)->count();
      $fotoPengantin = Pesanan::where("model_type", FotoPengantin::class)->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $key + 1)->count();
      $data[] = [
        "years" => $i,
        "undangan" => $undangan,
        "fotoPengantin" =>  $fotoPengantin,
      ];
    }
    return $data;
  }
  public function dataDoughnut()
  {
    $year = date("Y");
    $undangan = Pesanan::where("model_type", Undangan::class)->whereYear("created_at", "=", $year)->count();
    $fotoPengantin = Pesanan::where("model_type", FotoPengantin::class)->whereYear("created_at", "=", $year)->count();
    $sertus = $undangan + $fotoPengantin;

    $data = [
      [
        "label" =>  "undangan",
        "nilai" => $undangan,
      ],
      [
        "label" => "Foto Pengantin",
        "nilai" => $fotoPengantin,
      ]
    ];
    return $data;
  }
}
