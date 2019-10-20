<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetugasRequest extends FormRequest
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
                'nama_petugas'=>'required|regex:/^[A-Za-z\s-_]+$/',
                'id_level'=>'required',
                'username'=>'required|min:3|max:12|unique:users,username',
                'password'=>'required'
            ];
        }
        else{
            return[
                'username'=>'max:12|unique:users,username'
            ];
        }
    }

    public function messages()
    {
        return[
            'nama_petugas.required'=>'Nama Petugas Harus Diisi !',
            'nama_petugas.regex'=>'Nama Harus Huruf Alfabet !',
            'id_level.required'=>'Pilih Level !',
            'username.required'=>'Username Harus Diisi !',
            'username.min'=>'Username Minimal 3 Karakter !',
            'username.max'=>'Username Maksimal 12 Karakter !',
            'username.unique'=>'Username Sudah Terdaftar !',
            'alamat.required'=>'Alamat Harus Diisi !',
            'password.required'=>'Password Harus Diisi !'
        ];
    }
}
