<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Засега true бидејќи немаме направено login систем.
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:200'],
            'body' => ['required', 'string', 'min:10'],
            'published' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must have at least :min characters.',
            'title.max' => 'The title cannot have more than :max characters.',
            'body.required' => 'The contents field is required.',
            'body.min' => 'The contents must have at least :min characters.',
        ];
    }
}