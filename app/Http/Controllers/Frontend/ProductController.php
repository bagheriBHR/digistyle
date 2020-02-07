<?php

namespace App\Http\Controllers\Frontend;

use App\AttributeGroup;
use App\Brand;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Psy\Util\Json;
use willvincent\Rateable\Rating;
use function foo\func;

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
        }else
            $productRating=null;
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
            $rating->user_id = Auth::user()->id;
            $rating->rating = $request->input('star');
            $product->rating()->save($rating);
            return redirect()->back();
        }else{
            Session::flash('info', 'برای امتیاز دهی باید وارد سایت شوید');
            return back();
        }
    }

    public function getProductByCategory($slug,$page=10)
    {
        $category = Category::where('slug',$slug)->first();
        $products = Product::with(['photos','categories'=>function($q) use ($category){
            $q->where('id',$category->id);
        }])->paginate($page);
        $brands = Brand::all();
        return view('frontend.category.index',compact(['products','category','brands']));
    }
    public function searchTitle(Request $request)
    {
        $query=$request->title;
        $categories = Category::with('photo')->where('parent_id',null)->get();
        $products=Product::with(['photos','categories'])
            ->where('name','like','%' . $query . '%')
            ->orderBy('created_at','desc')
            ->get();
        return view('frontend.product.search',compact(['products','query','categories']));
    }

    public function apiGetProduct($id)
    {
        $products = Product::with('photos')->whereHas('categories', function($q) use ($id){
            $q->where('id',$id);
        })->paginate(4);
        $response =[
            'products' => $products
        ];
        return response()->json($response, 200);
    }
    public function apiGetSortProduct($id,$sort,$paginate){
        $products = Product::with('photos')->whereHas('categories', function($q) use ($id){
            $q->where('id',$id);
        })->orderBy('price',$sort)
            ->paginate($paginate);
        $response =[
            'products' => $products
        ];
        return response()->json($response, 200);
    }

    public function apiGetCategoryAttributeGroups($id)
    {
        $attributeGroups = AttributeGroup::with(['attributeValues'])->whereHas('categories', function($q) use($id){
            $q->where('category_id',$id);
        })->get();
        $response =[
            'attributeGroups' => $attributeGroups
        ];
        return response()->json($response, 200);
    }

    public function apiGetFilterProuct($id,$sort,$paginate,$attributes)
    {
        $attributesArray = json_decode($attributes, true);
        $products = Product::with('photos')->whereHas('categories', function($q) use ($id){
            $q->where('id',$id);
        })->whereHas('attributeValues', function($q) use ($attributesArray){
            $q->whereIn('attributeValue_id',$attributesArray);
        })->orderBy('price',$sort)
            ->paginate($paginate);
        $response =[
            'products' => $products
        ];
        return response()->json($response, 200);
    }
    public function searchProductInCategory($id,$item,$sort,$paginate)
    {
        $products = Product::with('photos')->whereHas('categories', function($q) use ($id){
            $q->where('id',$id);
        })->where('name','like','%' . $item . '%')
            ->orderBy('price',$sort)
            ->paginate($paginate);
        $response =[
            'products' => $products
        ];
        return response()->json($response, 200);
    }

    public function brandFilterProduct($id,$item,$sort,$paginate)
    {
        $products = Product::with('photos')->whereHas('categories', function($q) use ($id){
            $q->where('id',$id);
        })->where('brand',$item)
            ->orderBy('price',$sort)
            ->paginate($paginate);
        $response =[
            'products' => $products
        ];
        return response()->json($response, 200);
    }

    //like functions
    public function productLike($id)
    {
        $product = Product::find($id);
//        return $post;
        $product->likes()->attach([Auth::user()->id]);
        $product->save();
        $userId = Auth::user()->id;
        $productLike = Product::with(['likes'=>function($q) use($userId){
            $q->where('user_id',$userId);
        }])->whereId($id)->first();
        return response()->json(['product'=>$productLike]);
    }
    public function productDislike($id)
    {
        $product = Product::find($id);
//        return $post;
        $product->likes()->detach([Auth::user()->id]);
        $product->save();
        $userId = Auth::user()->id;
        $productLike = Product::with(['likes'=>function($q) use($userId){
            $q->where('user_id',$userId);
        }])->whereId($id)->first();
        return response()->json(['product'=>$productLike]);
    }

    public function apiLikeCheck($id)
    {
        $userId = Auth::user()->id;
        $product = Product::with(['likes'=>function($q) use($userId){
            $q->where('user_id',$userId);
        }])->whereId($id)->first();
        return response()->json(['product'=>$product],200);

    }
}
