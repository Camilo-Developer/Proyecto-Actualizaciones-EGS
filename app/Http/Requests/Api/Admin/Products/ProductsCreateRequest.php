<?php

namespace App\Http\Requests\Api\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductsCreateRequest extends FormRequest
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
            'version' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'version' => 'Version',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio',
            'version.required' => 'La version del producto es obligatoria',
        ];
    }
}
