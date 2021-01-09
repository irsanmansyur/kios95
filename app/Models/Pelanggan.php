<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $with = ["user"];
  public function pesanans()
  {
    return $this->hasMany(Pesanan::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
