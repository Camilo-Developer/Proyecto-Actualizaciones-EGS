<?php

namespace App\Http\Requests\Api\Admin\Logsuptproorgs;

use Illuminate\Foundation\Http\FormRequest;

class LogsuptproorgsCreateRequest extends FormRequest
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
            'uptproorganization_id' => 'required',
            'proyect_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'description' => 'Descripción',
            'uptproorganization_id' => 'Actualizacion de projectos de la organización',
            'proyect_id' => 'Proyecto',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'La descripción es obligatoria',
            'uptproorganization_id.required' => 'La Actualizacion de projectos de la organización es obligatoria',
            'proyect_id.required' => 'El proyecto es obligatorio',
        ];
    }
}
