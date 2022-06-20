<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaperIlmiahUpdateRequest extends FormRequest
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
            'judul' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'media' => 'required',
            'issn' => 'required',
            'sebagai' => 'required',
            'indexs' => 'required',
            'kriteria' => 'required',
            'link' => 'required',
        ];
    }
}
