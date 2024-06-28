<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:500',
            'description' => 'required|string|max:5000',
            'photos_url' => 'sometimes|array',
            'photos_url.*' => 'image|mimes:jpg,png',
            'house_id' => 'required|integer|exists:houses,id',
            'floor_id' => 'required|integer|exists:floors,id',
        ];
    }
}
