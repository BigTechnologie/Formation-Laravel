<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Test
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $imageRules = request()->isMethod("POST") ?
            "required|image|mimes:jpeg,jpg,png,webp,gif|max:2048":
            "nullable|image|mimes:jpeg,jpg,png,webp,gif|max:2048";

        $titleRules = [
            'required',
            'min:4',
            'max:60',
            Rule::unique('posts', 'title')->ignore('id'),

        ];

        return [
            "title" => $titleRules,
            "slug" => '',
            "imageUrl" => $imageRules,
            "category_id" => 'required|exists:categories,id',
            "description" => "required|min:15|max:255",
            "content" => "required|max:3000",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "slug" => Str::slug($this->input("title")), // Str::slug("Hello World) -> hello-world
        ]);
    }

}
