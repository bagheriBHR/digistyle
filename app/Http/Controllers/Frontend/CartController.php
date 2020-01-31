<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        $product = Product::with('photos')->whereId($id)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
//      dd(Session::get('cart' ));
        return back();
    }

    public function RemoveItem(Request $request, $id){
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($product, $product->id);
        $request->session()->put('cart', $cart);
        return back();
    }

    public function getCart()
    {
        $cart = Session::has('cart') ? Session::get('cart') : '';
        return view('frontend.cart.index',compact(['cart']));
    }
}
