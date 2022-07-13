<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
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
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'provinsi_id' => $this->provinsi_id,
            'kabupaten_id' => $this->kabupaten_id,
            'kecamatan_id' => $this->kecamatan_id,
            'alamat' => $this->alamat,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'kepesertaan' => $this->kepesertaan,
            'kategori' => $this->kategori,
            'foto' => asset('berkas/agenda/'.$this->foto),
            'jenis' => $this->jenis,
            'user_created' => $this->user_created,
        ];
    }
}
