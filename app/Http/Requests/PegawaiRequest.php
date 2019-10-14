<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
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
        if(request()->isMethod('POST')){
            return [
                'nama_pegawai'=>'required|alpha',
                'nip'=>'required|numeric|unique:pegawai,nip',
                'alamat'=>'required'
            ];
        }
        else{
            return [
                'nip'=>'max:7|unique:pegawai,nip',
            ];
        }
    }

    public function messages()
    {
        return[
            'nama_pegawai.required'=>'Nama Pegawai Harus Diisi !',
            'nama_pegawai.alpha'=>'Nama Harus Huruf Alfabet !',
            'nip.max'=>'Maksimal 7 Angka !',
            'nip.required'=>'NIP Harus Diisi !',
            'nip.numeric'=>'NIP Harus Angka !',
            'nip.unique'=>'NIP Sudah Terdaftar !',
            'alamat.required'=>'Alamat Harus Diisi !'
        ];
    }
}
