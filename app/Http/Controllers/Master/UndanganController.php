<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\BaseAdminController;
use App\Models\Undangan;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;

class UndanganController extends BaseAdminController
{
  public function index()
  {
    $undangan = new Undangan();
    $undangan->kode_undangan =  getLastId($undangan, "kode_undangan", "UND-" . date("Ymd") . "-");
    return view("Master.Undangan.index", [
      "undangan" => $undangan,
      "undangans" => Undangan::get(),
    ]);
  }
  public function create()
  {
    return view("Permission.Undangan.create", [
      "undangan" => new Undangan(),
    ]);
  }
  public function store()
  {
    $attr =    request()->validate([
      "kode_undangan" => "required|unique:undangans,kode_undangan",
      "nama_undangan" => "required|min:3",
      "harga_beli" => "nullable|numeric",
      "harga_jual" => "numeric",
      "stock" => "numeric",
    ]);
    Undangan::create($attr);
    return back()->with('success', "Undangan Ditambahkan");
  }
  public function edit(Undangan $undangan)
  {
    return view("Master.Undangan.Edit", [
      'submit' => "Update",
      "undangan" => $undangan,
    ]);
  }
  public function update(Undangan $undangan)
  {
    $attr =    request()->validate([
      "nama_undangan" => "required|min:3",
      "harga_beli" => "nullable|numeric",
      "harga_jual" => "numeric",
      "stock" => "numeric",
    ]);
    $undangan->update($attr);
    return redirect()->to(route("mUndangan"));
  }
  public function destroy(Undangan $undangan)
  {
    return response()->json([
      'status' =>  $undangan->delete(),
    ]);
  }
  public function updateStatus(Undangan $undangan)
  {
    $undangan->status = request("status");
    return response()->json([
      "data" => request("status"),
      'status' =>    $undangan->update(),
    ]);
  }
  public function select2()
  {
    $search = request('search');
    if (!$search)
      return response()->json(Undangan::paginate(20));
    return response()->json(Undangan::where('nama_undangan', 'like', '%' . $search . '%')
      ->orWhere('kode_undangan', 'like', '%' . $search . '%')->paginate(20));
  }
}
