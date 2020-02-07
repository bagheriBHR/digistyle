<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::paginate(20);
        return view('admin.order.index',compact(['orders']));
    }

    public function orderList($id)
    {
        $order = Order::with('products','user')->whereId($id)->first();
        return view('admin.order.orderList',compact(['order']));
    }
}
