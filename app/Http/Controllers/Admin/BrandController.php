<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Brand;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::with('photo')->get();
        return view('admin.brand.index',compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand= new Brand();
        $brand->name=$request->name;
        $brand->desc=$request->desc;
        $brand->photo_id=$request->photo_id;
        $brand->save();

        Session::flash('success','برند با موفقیت درج گردید.');
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::with('photo')->where('id',$id)->first();
        return view('admin.brand.edit',compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand= Brand::find($id);
        $brand->name=$request->name;
        $brand->desc=$request->desc;
        $brand->photo_id=$request->photo_id;
        $brand->save();

        Session::flash('success','برند با موفقیت بروزرسانی گردید.');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $brand=Brand::with('photo')->whereId($id)->first();
       //for showing image the url is:/storage/photos/imagName
        //for deleting image the url is:public/photos/image
        //so we need to ommit storage from the path
        // the storage is added to path by accessor in photo model
       $dir= str_replace('/storage/','',$brand->photo->path);
       Storage::disk('public')->delete($dir);
       //the bellow works when we dont use accessors
//       Storage::disk('public')->delete('photos/'. $brand->photo->path);
       Photo::find($brand->photo_id)->delete();
        Session::flash('delete','برند با موفقیت حذف گردید.');
        return redirect()->route('brand.index');
    }
}
