<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Jenis;

class JenisRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'nama_jenis' => 'required',
                'kode_jenis' => 'required|min:3|max:7|unique:jenis,kode_jenis',
                'keterangan' => 'required',
            ];
        }
        else{
            return [
                'nama_jenis' => 'required',
                'kode_jenis' => 'max:7|unique:jenis,kode_jenis',
                'keterangan' => 'required',
            ];
        }
    }

    public function messages()
    {
        return[
            'nama_jenis.required' => 'Nama Jenis Harus Diisi !',
            'kode_jenis.required' => 'Kode Jenis Harus Diisi !',
            'kode_jenis.min' => 'Minimal 3 Karakter !',
            'kode_jenis.max' => 'Maksimal 7 Karakter !',
            'kode_jenis.unique'=>'Kode Jenis Ini Sudah Terdaftar !',
            'keterangan.required' => 'Keterangan Harus Diisi !',
        ];
    }
}
