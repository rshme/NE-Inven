<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarisRequest extends FormRequest
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
        return [
            'nama'=>'required',
            'id_jenis'=>'required',
            'id_ruang'=>'required',
            'kondisi'=>'required',
            'keterangan'=>'required',
            'jumlah'=>'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'nama.required'=>'Nama Barang Harus Diisi !',
            'id_jenis.required'=>'Pilih Jenis Barang !',
            'id_ruang.required'=>'Pilih Ruang !',
            'kondisi.required'=>'Kondisi Barang Harus Diisi !',
            'keterangan.required'=>'Keterangan Harus Diisi !',
            'jumlah.required'=>'Jumlah Harus Diisi !',
            'jumlah.integer'=>'Jumlah Harus Berupa Angka !',
        ];
    }
}
