<?php

namespace App\Http\Requests\Instituicao;

use Illuminate\Foundation\Http\FormRequest;

class InstituicaoValidade extends FormRequest
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
            'sigla' => 'required|max:6',
            'nome' => 'required|max:60'
        ];
    }
}
