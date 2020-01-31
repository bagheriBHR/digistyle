<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index',compact(['coupons']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'code' => 'required',
            'price' => 'required',
            'status' => 'required',
        ],[
            'title.required' => 'عنوان کد تخفیف شما باید درج شود',
            'status.required' => 'وضعیت کد تخفیف را مشخص کنید',
            'code.required' => 'کد تخفیف را وارد کنید',
            'price.required' => 'قیمت تخفیف را وارد کنید'
        ]);

        if($validator->fails()){
            return redirect()->route('coupon.create')->withErrors($validator)->withInput();
        }else{
            $coupon = new Coupon();
            $coupon->title = $request->title;
            $coupon->price = $request->price;
            $coupon->code = $request->code;
            $coupon->status = $request->status;
            $coupon->save();

            Session::flash('success', 'کد تخفیف شما با موفقیت درج گردید.');
            return redirect()->route('coupon.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit',compact(['coupon']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required',
            'price' => 'required',
            'status' => 'required',
        ],[
            'title.required' => 'عنوان کد تخفیف شما باید درج شود',
            'status.required' => 'وضعیت کد تخفیف را مشخص کنید',
            'code.required' => 'کد تخفیف را وارد کنید',
            'price.required' => 'قیمت تخفیف را وارد کنید'
        ]);

            $coupon = Coupon::find($id);
            $coupon->title = $request->title;
            $coupon->price = $request->price;
            $coupon->code = $request->code;
            $coupon->status = $request->status;
            $coupon->save();

            Session::flash('success', 'کد تخفیف شما با موفقیت ویرایش گردید.');
            return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id)->delete();

        Session::flash('delete', 'کد تخفیف شما با موفقیت حذف گردید.');
        return back();
    }
}
