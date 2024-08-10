<?php

namespace App\Http\Requests\Api\Admin\Proyects;

use Illuminate\Foundation\Http\FormRequest;

class ProyectsCreateRequest extends FormRequest
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
            'product_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'product_id' => 'Producto',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del proyecto es obligatorio',
            'product_id.required' => 'El producto del proyecto es obligatorio',
        ];
    }
}
