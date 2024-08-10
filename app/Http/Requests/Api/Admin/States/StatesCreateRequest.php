<?php

namespace App\Http\Requests\Api\Admin\States;

use Illuminate\Foundation\Http\FormRequest;

class StatesCreateRequest extends FormRequest
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
            'name' => 'required',
            'type_state' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'type_state' => 'Tipo de estado',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del estado es obligatorio',
            'type_state.required' => 'El tipo de estado es obligatorio',
        ];
    }
}
