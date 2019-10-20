<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
            'id_inventaris'=>'required',
            'jumlah'=>'required|integer',
            'id_pegawai'=>'required',
            // 'status_peminjaman'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'id_inventaris.required'=>'Pilih Barang Yang Tersedia !',
            'jumlah.required'=>'Jumlah Barang Harus Diisi !',
            'jumlah.integer'=>'Jumlah Harus Angka !',
            'id_pegawai.required'=>'Pilih Pegawai Yang Tersedia !',
            // 'status_peminjaman.required'=>'Pilih Status Peminjaman Yang Tersedia !'
        ];
    }
}
