<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
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
        if ($this->input('publish') == null) {
            $this->merge([
                'publish' => false,
            ]);
        }

        if ($this->input('slug') == null) {
            $this->merge([
                'slug' => Str::slug($this->input('title')),
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
        $id = $this->route('news')->id ?? false;

        return [
            'title'       => [
                'required',
                'between:5,150',
                $id ? Rule::unique('news')->ignore($id) : 'unique:news,title',
            ],
            'slug'        => [
                $id ? Rule::unique('news')->ignore($id) : 'nullable',
            ],
            'description' => 'required',
            'body'        => 'required',
            'publish'     => 'nullable|boolean',
        ];
    }
}
