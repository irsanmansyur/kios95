<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\returnSelf;

class PesananResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $data = parent::toArray($request);
    $data["tanggal_bayar"] =  $data["created_at"] = $this->created_at->format("d F Y");

    $data['pelanggan'] = new PelangganResource($this->pelanggan);
    return $data;
  }
}
