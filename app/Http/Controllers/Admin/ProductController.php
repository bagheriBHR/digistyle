<?php

namespace App\Http\Controllers\Admin;
use App\Brand;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(10);
        return view('admin.product.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with(['childrenRecursive'])
            ->where('parent_id',null)
            ->get();
        $brands=Brand::all();
        return view('admin.product.create',compact(['categories','brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeSKU()
    {
        $number = mt_rand(1000,99999);
        if($this->checkSKU($number)){
            return $this->makeSKU($number);
        }
        return (string)$number;
    }

    public function checkSKU($number)
    {
        return Product::where('sku',$number)->exists();
    }
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        if($request->slug){
            $product->slug =make_slug($request->slug);
        }else{
            $product->slug =make_slug($request->name);
        }
        $product->sku = $this->makeSKU();
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $product->meta_title = $request->meta_title;
        $product->meta_desc = $request->meta_desc;
        $product->meta_keywords = $request->meta_keywords;
        $product->user_id =Auth::user()->id;
        $product->brand_id = $request->brand_id;
        $product->save();

        $product->categories()->sync($request->categories);

        $attributeValue = explode(',',$request->input('attributes')[0]);
        $product->attributeValues()->sync($attributeValue);

        $photo = explode(',',$request->input('photo_id')[0]);
        $product->photos()->sync($photo);

        Session::flash('success','محصول با موفقیت ثبت گردید.');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['categories','brand','photos','attributeValues'])->whereId($id)->first();
        $brands = Brand::all();
        return view('admin.product.edit',compact(['product','brands']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product =Product::find($id);
        $product->name = $request->name;
        if($request->slug){
            $product->slug =make_slug($request->slug);
        }else{
            $product->slug =make_slug($request->name);
        }
//        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $product->meta_title = $request->meta_title;
        $product->meta_desc = $request->meta_desc;
        $product->meta_keywords = $request->meta_keywords;
        $product->user_id =Auth::user()->id;
        $product->brand_id = $request->brand_id;
        $product->save();

        $product->categories()->sync($request->categories);

        $attributeValue = explode(',',$request->input('attributes')[0]);
        $product->attributeValues()->sync($attributeValue);

        $photo = explode(',',$request->input('photo_id')[0]);
        $product->photos()->sync($photo);

        Session::flash('success','محصول با موفقیت ویرایش گردید.');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        Session::flash('delete','محصول با موفقیت حذف گردید.');
        return redirect()->route('product.index');
    }
}
