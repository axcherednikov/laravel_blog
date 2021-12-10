<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (empty($this->input('slug'))) {
            $this->merge([
                'slug' => Str::slug($this->input('title')),
            ]);
        }

        if ($this->input('publish') == null) {
            $this->merge([
                'publish' => false,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $idPost = $this->route('post')->id ?? null;

        return [
            'slug'        => [
                'nullable',
                'regex:~^[a-zA-Z0-9_-]+$~',
                'alpha_dash',
                isset($idPost) ? Rule::unique('posts')->ignore($idPost) : 'unique:posts,slug',
            ],
            'title'       => [
                'required',
                'between:5,100',
                isset($idPost) ? Rule::unique('posts')->ignore($idPost) : 'unique:posts,title',
            ],
            'description' => 'required|max:255',
            'body'        => 'required',
            'publish'     => 'nullable|boolean',
        ];
    }
}
