<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    public function verify(){
        $cart = Session::has('cart') ? Session::get('cart') : null;
        if(!$cart){
            Session::flash('warning', "سبد خرید شما خالی است.");
            return redirect('/');
        }else{
            $productId = [];
            foreach ($cart->items as $product){
                $productId[$product['item']->id] =['QTY' => $product['qty']];
            }

            $order = new Order();
            $order->status = 0;
            $order->amount = $cart->totalPrice;
            $order->user_id = Auth::user()->id;
            $order->save();

            $order->products()->sync($productId);

            $payment = new Payment($order->amount,$order->id);
            $result = $payment->doPayment();
            if ($result->Status == 100) {
                return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
            } else {
                echo'ERR: '.$result->Status;
            }

        }
    }

    public function index()
    {
        $orders = Order::all();
        return view('frontend.profile.orders',compact(['orders']));
    }

    public function orderList($id)
    {
        $order = Order::with('products','user')->whereId($id)->first();
        return view('frontend.profile.list',compact(['order']));
    }
}
