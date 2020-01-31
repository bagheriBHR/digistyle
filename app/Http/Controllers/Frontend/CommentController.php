<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        $product=Product::find($id);
        if($product){
            $comment=new Comment();
            $comment->description = $request->description;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->product_id = $id;
            $comment->status = 0;
            $comment->save();
            Session::flash('success','نظر شما با موفقیت درج گردید و در انتظار تایید مدیر میباشد.');
        }
        return back();
    }
    public function reply(Request $request)
    {
//        return $request;
        $product=Product::find($request->input('product_id'));
        if($product){
            $comment=new Comment();
            $comment->description = $request->description;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->product_id = $product->id;
            $comment->status = 0;
            $comment->parent_id=$request->input('parent_id');
            $comment->save();
            Session::flash('success','نظر شما با موفقیت درج گردید و در انتظار تایید مدیر میباشد.');
        }
        return back();
    }
}
