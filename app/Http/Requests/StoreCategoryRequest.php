<?php
// File: app/Http/Requests/StoreCategoryRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a string.',
            'name.max' => 'The category name may not be greater than 255 characters.',
            'name.unique' => 'A category with this name already exists.',
        ];
    }
}