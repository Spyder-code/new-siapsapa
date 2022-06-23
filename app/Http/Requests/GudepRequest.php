<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GudepRequest extends FormRequest
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
            'npsn' => 'required',
            'nama_sekolah' => 'required',
            'no_putra' => 'required|size:3',
            'no_putri' => 'required|size:3',
            'nama_gudep_putra' => 'required',
            'nama_gudep_putri' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
        ];
    }
}
