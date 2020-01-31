<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function addCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ],
        ['code.required'=>'لطفا کد تخفیف را وارد کنید.']
        );

        $check = Auth::user()->whereHas('coupons',function($q) use($request){
            $q->where('code',$request->code);
        })->exists();
//        if the user has not used the coupon, add it to the pivot table and decrease the total price
        if(!$check){
            $cart = Session::has('cart') ? Session::get('cart') : '';
            $cart = new Cart($cart);
            $coupon = Coupon::where('code',$request->code)->first();
            $cart->addCoupon($coupon);
            $request->session()->put('cart',$cart);

            $user = Auth::user();
            $user->coupons()->attach($coupon->id);
            $user->save();

            return back();
        }else{
            Session::flash('warning','شما قبلا از این کد تخفیف استفاده کرده اید');
            return back();
        }
    }
}
