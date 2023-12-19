<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormationRequest extends FormRequest
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
            'titre' => 'required|string|max:255',
            'criteres' => 'required|text',
            'duree' => 'required|numeric|min:1',
            'etat' => 'required|in:ouverte,cloturee', 
            'archive' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'titre.required' => 'Le champ "titre" est obligatoire.',
            'titre.string' => 'Le champ "titre" doit être une chaîne de caractères.',
            'titre.max' => 'Le champ "titre" ne doit pas dépasser :max caractères.',

            'criteres.required' => 'Le champ "criteres" est obligatoire.',
            'criteres.text' => 'Le champ "criteres" doit être un texte.',

            'duree.required' => 'Le champ "duree" est obligatoire.',
            'duree.numeric' => 'Le champ "duree" doit être un nombre.',
            'duree.min' => 'Le champ "duree" doit être d\'au moins :min.',
        ];
    }
}
