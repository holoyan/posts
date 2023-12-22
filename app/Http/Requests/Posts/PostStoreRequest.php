<?php

namespace App\Http\Requests\Posts;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'user_id' => 'required|numeric', //
            'title' => 'required|string|max:' . Post::TITLE_MAX_LENGTH,
            'body' => 'required|string|max:' . Post::BODY_MAX_LENGTH,
            'is_published' => 'required|boolean'
        ];
    }
}
