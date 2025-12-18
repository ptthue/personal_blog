<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tags' => ['required', 'string' ],
        ];
    }
}
