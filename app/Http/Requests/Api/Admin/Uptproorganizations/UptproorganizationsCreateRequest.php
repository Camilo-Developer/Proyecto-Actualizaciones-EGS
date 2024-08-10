<?php

namespace App\Http\Requests\Api\Admin\Uptproorganizations;

use Illuminate\Foundation\Http\FormRequest;

class UptproorganizationsCreateRequest extends FormRequest
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
            'description' => 'required',
            'user_id' => 'required',
            'organization_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'description' => 'Descripción',
            'user_id' => 'Usuario',
            'organizations_id' => 'Organización',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'La descripción de la actualizacion es obligatoria',
            'user_id.required' => 'El usuario es obligatorio',
            'organizations_id.required' => 'La organización es obligatorio',
        ];
    }
}
