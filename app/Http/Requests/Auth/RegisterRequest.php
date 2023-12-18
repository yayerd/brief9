<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator ;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            
                'prenom' => 'required|string|max:255',
                'nom' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'date_naissance' => 'required|date',
                'password' => 'required|string|min:8'
                
        ];
    }

    public function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'error'   => true,
            'message'   => 'Erreur de validation',
            'errorLists'  => $validator->errors()

        ]));
    }

    public function messages()
{
    return [
        'prenom.required' => 'Le prénom est obligatoire.',
        'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
        'prenom.max' => 'Le prénom ne peut pas dépasser :max caractères.',

        'nom.required' => 'Le nom est obligatoire.',
        'nom.string' => 'Le nom doit être une chaîne de caractères.',
        'nom.max' => 'Le nom ne peut pas dépasser :max caractères.',

        'username.required' => 'Le nom d\'utilisateur est obligatoire.',
        'username.string' => 'Le nom d\'utilisateur doit être une chaîne de caractères.',
        'username.max' => 'Le nom d\'utilisateur ne peut pas dépasser :max caractères.',
        'username.unique' => 'Ce nom d\'utilisateur est déjà utilisée.',

        'email.required' => 'L\'adresse e-mail est obligatoire.',
        'email.string' => 'L\'adresse e-mail doit être une chaîne de caractères.',
        'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
        'email.max' => 'L\'adresse e-mail ne peut pas dépasser :max caractères.',
        'email.unique' => 'Cette adresse e-mail est déjà utilisée par un autre utilisateur.',

        'date_naissance.required' => 'La date de naissance est obligatoire.',
        'date_naissance.date' => 'La date de naissance doit être une date valide.',

        'password.required' => 'Le mot de passe est obligatoire.',
        'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
        'password.min:8' => 'Le mot de passe doit être 8 caractères au minimum.',
        // 'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
    ];
}

}
