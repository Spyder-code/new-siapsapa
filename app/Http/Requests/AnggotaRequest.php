<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggotaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nik' => 'required|numeric|unique:tb_anggota,nik,'.$this->id,
            'email' => 'required|unique:tb_anggota,email,'.$this->id,
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'tempat_lahir' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'gol_darah' => 'required',
            'nohp' => 'required|numeric',
            'alamat' => 'required|max:64',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'gudep' => 'nullable',
            'status_anggota' => 'required',
            'foto' => 'nullable',
            'kawin' => 'required',
        ];
    }
}
