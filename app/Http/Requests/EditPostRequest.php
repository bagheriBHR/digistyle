<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        if ($this->slug) {
            $this->merge(['slug' => make_slug($this->slug)]);
        } else {
            $this->merge(['slug' => make_slug($this->title)]);
        }
    }

    public function rules()
    {
        return [
            'title' => 'required|min:10',
            'description' => 'required',
            'slug' => Rule::unique('posts')->ignore(request()->post),
            'category' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان مطلب را وارد نمایید.',
            'title.min'=>'عنوان نباید کمتر از 10 کاراکتر باشد',
            'description.required' => 'لطفا توضیحات مطلب را وارد نمایید.',
            'slug.unique' => 'لطفا نام مستعار دیگری انتخاب کنید.',
            'category.required' => 'لطفا دسنه بندی خود را انتخاب کنید.',
            'status.required' => 'لطفا وضعیت مطلب را مشخص کنید.',
        ];

    }
}
