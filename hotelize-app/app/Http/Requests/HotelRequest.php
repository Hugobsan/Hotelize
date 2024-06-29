<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:hotels,name,' . $this->route('hotel') . ',id',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|regex:/^\d{5}-\d{3}$/',
            'website' => 'url|nullable|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'address' => 'endereço',
            'city' => 'cidade',
            'state' => 'estado',
            'zip_code' => 'CEP',
            'website' => 'site',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'zip_code.regex' => 'O CEP deve estar no formato 99999-999.',
        ];
    }
}
