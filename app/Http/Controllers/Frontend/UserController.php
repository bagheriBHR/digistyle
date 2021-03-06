<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(RegisterRequest $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->national_code = $request->input('national_code');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password =Hash::make($request->input('password')) ;
        $user->save();
        $role = Role::where('name','کاربر عادی')->first();
        $user->roles()->sync($role->id);

        $address = new Address();
        $address->address = $request->input('address');
        $address->company = $request->input('company');
        $address->post_code = $request->input('post_code');
        $address->province_id = $request->input('province_id');
        $address->city_id = $request->input('city_id');
        $address->user_id = $user->id;
        $address->save();

        Session::flash('success', 'ثبت نام شما با موفقیت انجام شد. لطفا حساب کاربری خود را تایید کنید');
        return redirect('/login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile.index',compact(['user']));
    }
}
