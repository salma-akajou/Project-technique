<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
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
            'description' => 'nullable|string',
            'directeur' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => __('films.validation.titre_required'),
            'titre.string' => __('films.validation.titre_string'),
            'titre.max' => __('films.validation.titre_max'),
            'description.string' => __('films.validation.description_string'),
            'directeur.required' => __('films.validation.directeur_required'),
            'directeur.string' => __('films.validation.directeur_string'),
            'directeur.max' => __('films.validation.directeur_max'),
            'image.image' => __('films.validation.image_invalid'),
            'image.mimes' => __('films.validation.image_type'),
            'image.max' => __('films.validation.image_size'),
            'categories.required' => __('films.validation.categories_required'),
            'categories.min' => __('films.validation.categories_required'),
            'categories.*.exists' => __('films.validation.categories_invalid'),
        ];
    }
}
