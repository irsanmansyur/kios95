<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $with = ["pelanggan", "undangan"];
  public function pelanggan()
  {
    return $this->belongsTo(Pelanggan::class);
  }
  public function undangan()
  {
    return $this->belongsTo(Undangan::class, "model_id");
  }
  // public function getCreatedAtAttribute($val)
  // {
  //   return (new Carbon($val))->format("d F Y");
  // }
  public function pembayaran()
  {
    return $this->hasOne(Pembayaran::class);
  }
}
