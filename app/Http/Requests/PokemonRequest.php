<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'total' => 'required|numeric|min:0',
            'hp' => 'required|numeric|min:0',
            'attack' => 'required|numeric|min:0',
            'defence'  => 'required|numeric|min:0',
            'special_attack' => 'required|numeric|min:0',
            'special_defence' => 'required|numeric|min:0',
            'speed' => 'required|numeric|min:0',
            'generation' => 'required|numeric|min:1',
            'legendary' => 'required|boolean',
            'types' => 'required|array'
        ];
    }
}
