<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use function PHPUnit\Framework\returnSelf;

class PesananCollection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $pesanans = $this->collection->map(function ($pes) {
      return  new PesananResource($pes);
    });

    return [
      'data' => $pesanans,
      'links' => [
        'self' => 'link-value'
      ],
    ];
  }
}
