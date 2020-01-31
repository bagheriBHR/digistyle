<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeGroupRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' =>['required',
                Rule::unique('attribute_groups')->ignore(request()->attributeGroup),
                ],
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'لطفا نام ویژگی را وارد کنید',
            'name.unique' => 'این نام قبلا ثبت شده. لطفا نام یکتا انتخاب کنید',
        ];

    }
}
