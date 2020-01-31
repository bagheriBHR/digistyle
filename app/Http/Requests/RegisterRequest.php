<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required |email |unique:users',
            'phone'=>'required |numeric',
            'national_code'=>'numeric|min:10|required',
            'address'=>'required',
            'post_code'=>'required|numeric',
            'province_id'=>'required',
            'city_id'=>'required',
            'password'=>'required|min:8',
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'لطفا نام خود را وارد کنید.',
            'last_name.required'=>'لطفا نام خانوادگی خود را وارد کنید.',
            'email.required'=>'لطفا ایمیل خود را وارد کنید.',
            'email.unique'=>'این ایمیل قبلا ثبت شده است.',
            'phone.required'=>'لطفا شماره تلفن خود را وارد کنید.',
            'phone.numeric'=>' شماره تلفن شما نامعتبر می باشد.',
            'national_code.numeric'=>' کد ملی شما نامعتبر می باشد.',
            'national_code.required'=>' لطفا کد ملی خود را وارد کنید.',
            'national_code.min'=>' کد ملی شما باید 10 کاراکتر باشد.',
            'address.required'=>' لطفا آدرس خود را وارد کنید.',
            'post_code.required'=>' لطفا کد پستی خود را وارد کنید.',
            'province_id.required'=>' لطفا نام استان خود را انتخاب کنید.',
            'city_id.required'=>' لطفا نام شهر خود را انتخاب کنید.',
            'password.required'=>' لطفا رمز عبور خود را وارد کنید.',
            'password.min'=>' رمز عبور شما باید 8 کاراکتر باشد.',
        ];

    }
}
