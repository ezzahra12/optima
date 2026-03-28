<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjetRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
   public function rules(): array
    {
        return [
            'titre' => 'required|min:3|max:255',
            'user_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'budget' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le nom du projet est obligatoire.',
            'user_id.required' => 'Veuillez choisir un chef de projet.',
        ];
    }
}
