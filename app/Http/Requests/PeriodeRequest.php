<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodeRequest extends FormRequest
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
            'begin' => 'required',
            'until' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'begin.required' => 'Tanggal Awal Harus Diisi !',
            'until.required' => 'Tanggal Akhir Harus Diisi !'
        ];
    }
}
