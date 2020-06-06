<?php

namespace App\Http\Requests\Unidade;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeValidate extends FormRequest
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
            'nome' => 'required|min:5|max:50',
            'logradouro' => 'required|min:5|max:70',
            'cep' => 'required|min:8|max:9',
            'bairro' => 'required|min:5|max:50',
        ];
    }
}
