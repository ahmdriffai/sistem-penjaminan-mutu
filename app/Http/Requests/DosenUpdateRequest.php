<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenUpdateRequest extends FormRequest
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
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'nomer_hp' => 'required',
            'alamat' => 'required',
        ];
    }
}
