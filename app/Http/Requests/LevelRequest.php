<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
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
            'nama_level'=>'required|unique:level,nama_level'
        ];
    }

    public function messages()
    {
        return [
            'nama_level.required'=>'Nama Level Harus Diisi !',
            'nama_level.unique'=>'Level Sudah Ada !'
        ];
    }
}
