<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuangRequest extends FormRequest
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
                'nama_ruang' => 'required',
                'kode_ruang' => 'required|min:3|max:7|unique:ruang,kode_ruang',
                'keterangan' => 'required',
            ];
        }
        else{
            return [
                'nama_ruang' => 'required',
                'kode_ruang' => 'max:7|unique:ruang,kode_ruang',
                'keterangan' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'nama_ruang.required' => 'Nama Ruang Harus Diisi !',
            'kode_ruang.required' => 'Kode Ruang Harus Diisi !',
            'kode_ruang.min' => 'Minimal 3 Karakter !',
            'kode_ruang.max' => 'Maksimal 7 Karakter !',
            'kode_ruang.unique' => 'Kode Ruang Ini Sudah Terdaftar !',
            'keterangan.required' => 'Keterangan Harus Diisi !',
        ];
    }
}
