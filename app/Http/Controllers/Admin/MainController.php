<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Order;
use App\Post;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $userCount = User::all()->count();
        $orderCount = Order::all()->count();
        $productCount = Product::all()->count();
        $postCount = Post::all()->count();
        $comments = Comment::with(['childrenRecursive'])->get();
        $products=Product::orderBy('created_at','desc')->limit(5)->get();
        $orders = Order::orderBy('created_at','desc')->limit(5)->get();
        return view('admin.dashboard.index',compact(['userCount','orderCount','productCount','comments','products','orders','postCount']));
    }
}
