<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreLaptopRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'model' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            
            // Variants validation
            'variants' => 'required|array|min:1',
            'variants.*.variant_name' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'nullable|integer|min:0',
            'variants.*.specifications' => 'nullable|string',
            
            // Images validation
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Promotions validation
            'promotions' => 'nullable|array',
            'promotions.*' => 'exists:promotions,id',
        ];
    }

    public function messages()
    {
        return [
            'model.required' => 'The laptop model is required.',
            'brand_id.required' => 'Please select a brand.',
            'brand_id.exists' => 'The selected brand does not exist.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be greater than or equal to 0.',
            'stock.required' => 'The stock quantity is required.',
            'stock.integer' => 'The stock must be a whole number.',
            'stock.min' => 'The stock must be greater than or equal to 0.',
            
            'variants.required' => 'At least one variant is required.',
            'variants.array' => 'Variants must be an array.',
            'variants.min' => 'At least one variant is required.',
            'variants.*.variant_name.required' => 'Variant name is required.',
            'variants.*.price.required' => 'Variant price is required.',
            'variants.*.price.numeric' => 'Variant price must be a number.',
            'variants.*.price.min' => 'Variant price must be greater than or equal to 0.',
            'variants.*.stock.integer' => 'Variant stock must be a whole number.',
            'variants.*.stock.min' => 'Variant stock must be greater than or equal to 0.',
            
            'images.array' => 'Images must be an array.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Images must be of type: jpeg, png, jpg, gif.',
            'images.*.max' => 'Each image may not be greater than 2MB.',
            
            'promotions.array' => 'Promotions must be an array.',
            'promotions.*.exists' => 'One or more selected promotions do not exist.',
        ];
    }
}