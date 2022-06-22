<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnggotaResource extends JsonResource
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
            'golongan' => $this->golongan->name,
            'nta' => $this->kode,
            'email' => $this->user->email,
            'nik' => $this->nik,
            'nama' => $this->nama,
            'tgl_lahir' => $this->tgl_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'jk' => $this->jk,
            'kawin' => $this->kawin,
            'agama' => $this->agama,
            'gol_darah' => $this->gol_darah,
            'no_hp' => $this->no_hp,
            'provinsi' => $this->province->name,
            'kabupaten' => $this->city->name,
            'kecamatan' => $this->district->name,
            'gudep' => $this->gudepInfo->nama_sekolah ?? null,
            'status_anggota' => $this->status_anggota,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
            'foto' => asset('berkas/anggota').'/'.$this->foto,
            'role' => $this->user->role,
        ];
    }
}
