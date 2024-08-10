<?php

namespace App\Http\Requests\Api\Admin\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionsCreateRequest extends FormRequest
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
            'date_init' => 'required',
            'date_finish' => 'required',
            'organization_id' => 'required',
            'state_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'date_init' => 'Fecha de inicio',
            'date_finish' => 'Fecha de finalización',
            'organization_id' => 'Organización',
            'state_id' => 'Estado',
        ];
    }

    public function messages()
    {
        return [
            'date_init.required' => 'La fecha de inicio es obligatoria',
            'date_finish.required' => 'La fecha de finalización es obligatoria',
            'organization_id.required' => 'La organizacion es obligatoria',
            'state_id.required' => 'El estado es obligatorio',
        ];
    }
}
