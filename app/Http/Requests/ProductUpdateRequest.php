<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function prepareForValidation()
    {
        if($this->input('slug')){
            $this->merge(['slug'=>make_slug($this->input('slug'))]);
        }else{
            $this->merge(['slug'=>make_slug($this->input('name'))]);
        }
    }

    public function rules()
    {
        return [
            'name'=>'required',
            'slug'=> Rule::unique('products')->ignore(request()->product),
            'status'=>'required',
            'price'=>'required',
            'short_desc'=>'required',
            'long_desc'=>'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'لطفا نام محصول را وارد کنید.',
            'slug.unique'=>'لطفا نام مستعار محصول باید یکتا باشد.',
            'status.required'=>'لطفا وضعیت نشر را مشخص کنید.',
            'price.required'=>'لطفا قیمت محصول را وارد کنید.',
            'short_desc.required'=>'لطفا توضیحات کوتاه محصول را وارد کنید.',
            'long_desc.required'=>'لطفا توضیحات بلند محصول را وارد کنید.',
        ];

    }
}
