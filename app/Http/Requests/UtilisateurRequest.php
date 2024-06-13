<?php

namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;

class UtilisateurRequest extends FormRequest
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
            'CIN' => 'required|between:6,10|unique:utilisateurs',
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'birth' => 'required|date',
            'phone_number' => 'required|unique:utilisateurs|string|max:255',
            'role' => 'required|in:fonctionnaire,chef,directeur,admin',
            'service_id' => 'required|exists:services,id',
        ];
    }
    public function messages()
    {
        return [
            'CIN.required' => 'La CIN est requis.',
            'CIN.unique' => 'La CIN doit être unique.',
            'CIN.min' => 'La CIN doit avoir au moins 6 caractères.',
            'CIN.max' => 'La CIN ne doit pas dépasser 10 caractères.',
            'name.required' => 'Le nom est requis.',
            'prenom.required' => 'Le prénom est requis.',
            'email.required' => 'L\'adresse e-mail est requis.',
            'email.unique' => 'L\'adresse e-mail doit être unique.',
            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            'phone_number.required' => 'Le numéro de téléphone est requis.',
            'phone_number.unique' => 'Le numéro de téléphone doit être unique.',
            'role.required' => 'Le rôle est requis.',
            'service_id.required' => 'Le service est requis.',
            'service_id.exists' => 'Le service sélectionné est invalide.'
        ];
    }
}
