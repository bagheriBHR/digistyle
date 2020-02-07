<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles','addresses'])->paginate(20);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact(['roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->national_code = $request->input('national_code');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password =Hash::make($request->input('password')) ;
        $user->photo_id = $request->photo_id;
        $user->save();
        $user->roles()->sync($request->roles);

        $address = new Address();
        $address->address = $request->input('address');
        $address->company = $request->input('company');
        $address->post_code = $request->input('post_code');
        $address->province_id = $request->input('province_id');
        $address->city_id = $request->input('city_id');
        $address->user_id = $user->id;
        $address->save();

        Session::flash('success', 'ثبت نام شما با موفقیت انجام شد.');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::with(['roles','addresses'])->whereId($id)->first();
        return view('admin.users.edit',compact(['user','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegisterRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->national_code = $request->input('national_code');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->photo_id = $request->photo_id;
        $user->save();
        $user->roles()->sync($request->roles);

        $address = Address::where('user_id',$id)->first();
        $address->address = $request->input('address');
        $address->company = $request->input('company');
        $address->post_code = $request->input('post_code');
        $address->province_id = $request->input('province_id');
        $address->city_id = $request->input('city_id');
        $address->user_id = $user->id;
        $address->save();

        Session::flash('success', 'مشخصات کاربر با موفقیت ویرایش شد.');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        Session::flash('delete', 'کاربر با موفقیت حذف گردید.');
        return redirect()->route('user.index');
    }


}
