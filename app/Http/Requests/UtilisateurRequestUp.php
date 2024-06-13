<?php

namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;

class UtilisateurRequestUp extends FormRequest
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
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'birth' => 'required|date',
            'phone_number' => 'required|string|max:255',
            'role' => 'required|in:fonctionnaire,chef,directeur,admin',
            'service_id' => 'required|exists:services,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Le nom est requis.',
            'prenom.required' => 'Le prénom est requis.',
            'role.required' => 'Le rôle est requis.',
            'service_id.required' => 'Le service est requis.',
            'service_id.exists' => 'Le service sélectionné est invalide.'
        ];
    }
}
