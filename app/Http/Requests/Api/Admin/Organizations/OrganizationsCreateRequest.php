<?php

namespace App\Http\Requests\Api\Admin\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationsCreateRequest extends FormRequest
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
            'subdomain' => 'required',
            'route' => 'required',
            'server' => 'required',
            'connection_db' => 'nullable',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'subdomain' => 'Subdominio',
            'route' => 'Ruta',
            'server' => 'Servidor',
            'connection_db' => 'Conexión a la base de datos',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la organización es obligatoria',
            'subdomain.required' => 'El subdominio de la organización es obligatoria',
            'route.required' => 'La ruta de la organización es obligatoria',
            'server.required' => 'El servidor de la organización es obligatoria',
            'connection_db.required' => 'La conexión de DB de la organización es obligatoria',
        ];
    }
}
