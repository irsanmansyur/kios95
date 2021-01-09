<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PelangganResource extends JsonResource
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
    $user = $this->user;
    $data['nama'] = $user->name;
    $data['email'] = $user->email;
    return $data;
  }
}
