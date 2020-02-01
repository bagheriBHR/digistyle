<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use willvincent\Rateable\Rating;

class ProductController extends Controller
{
    public function getProduct($slug)
    {
        $product = Product::with(['photos','attributeValues.attributeGroup','categories','brand','comments'=>function($q){
            $q->where('parent_id',null)
                ->where('status',1);
        },'comments.childrenRecursive'=>function($q){
            $q->where('status',1);
        }])->whereSlug($slug)->first();
        $user = Auth::user();
        if(Auth::check()){
            $productRating = Product::with(['rating'=> function($q) use($user){
                $q->where('user_id',$user->id);
            }])->where('slug',$slug)->first();
        }else{
            $productRating = Product::with(['rating'])->where('slug',$slug)->first();
        }
//        return $productRating->rating;
        $relatedProduct = Product::with(['photos','categories'=>function($q) use($product){
            $q->whereIn('id',$product->categories);
        }])->get();

        return view('frontend.product.index',compact(['product','productRating','relatedProduct']));
    }

    public function productStar (Request $request, Product $product) {
        if(Auth::check()){
            $user = Auth::user();
            $oldRating = Rating::where('user_id',$user->id)->first();
            if($oldRating){
                $rating = $oldRating;
            }
            else{
                $rating = new Rating();
            }
            $rating->user_id = Auth::id();
            $rating->rating = $request->input('star');
            $product->rating()->save($rating);
            return redirect()->back();
        }else{
            return back();
        }
    }

    public function getProductByCategory($slug,$page=10)
    {
        $category = Category::where('slug',$slug)->first();
        $products = Product::with(['photos','categories'=>function($q) use ($category){
            $q->where('id',$category->id);
        }])->paginate($page);
        return view('frontend.category.index',compact(['products','category']));
    }

    public function apiGetProduct($id)
    {
        $products = Product::with('photos')->whereHas('categories', function($q) use ($id){
            $q->where('id',$id);
        })->paginate(1);
        $response =[
            'products' => $products
        ];
        return response()->json($response, 200);
    }
}
