<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'kta_id' => $this->kta_id,
            'user_id' => $this->user_id,
            'anggota_id' => $this->anggota_id,
            'harga' => $this->harga,
            'golongan' => $this->golongan
        ];
    }
}
