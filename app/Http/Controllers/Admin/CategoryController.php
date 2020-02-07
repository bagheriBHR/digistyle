<?php

namespace App\Http\Controllers\Admin;

use App\AttributeGroup;
use App\Http\Controllers\Controller;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::with(['childrenRecursive'])
        ->where('parent_id',null)
        ->paginate(2);
        return view('admin.caterory.index',compact(['categories']));
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
        return view('admin.caterory.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category=new Category();
        $category->name=$request->name;
        if($request->slug){
            $category->slug =make_slug($request->slug);
        }else{
            $category->slug =make_slug($request->name);
        }
        $category->meta_title=$request->meta_title;
        $category->meta_desc=$request->meta_desc;
        $category->meta_keywords=$request->meta_keywords;
        $category->parent_id=$request->parent_id;
        $category->photo_id=$request->photo_id;
        $category->save();
        Session::flash('category_add','دسته بندی با موفقیت ثبت گردید.');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category=Category::with(['photo'])->whereId($id)->first();
       $categories=Category::with(['childrenRecursive','photo'])
           ->where('parent_id',null)
           ->get();
       return view('admin.caterory.edit',compact(['categories','category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request,$id)
    {
        $category=Category::find($id);
        $category->name=$request->name;
        if($request->slug){
            $category->slug =make_slug($request->slug);
        }else{
            $category->slug =make_slug($request->name);
        }
        $category->meta_title=$request->meta_title;
        $category->meta_desc=$request->meta_desc;
        $category->meta_keywords=$request->meta_keywords;
        $category->parent_id=$request->parent_id;
        $category->photo_id = $request->photo_id;
        $category->save();
        Session::flash('category_update','دسته بندی با موفقیت ویرایش گردید.');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::with('childrenRecursive','photo')->where('id',$id)->first();
        if(count($category->childrenRecursive)>0){
            Session::flash('error_category','دسته ' .$category->name.' دارای زیر دسته است و قابل حذف نیست. ');
            return redirect()->route('category.index');
        }
        $dir= str_replace('/storage/','',$category->photo->path);
        Storage::disk('public')->delete($dir);
        Photo::find($category->photo_id)->delete();
        $category->delete();
        Session::flash('category_delete','دسته ' .$category->name.'با موفقیت حذف گردید. ');
        return redirect()->route('category.index');
    }

    public function createSetting($id)
    {
        $category=Category::find($id);
        $attributeGroup=AttributeGroup::all();
        return view('admin.caterory.addSetting',compact(['category','attributeGroup']));
    }
    public function addSetting(Request $request,$id)
    {
        $category=Category::find($id);
        $category->attributeGroups()->sync($request->attributeGroup_id);
        $category->save();
        return redirect()->route('category.index');

    }

    public function apiIndex()
    {
        $categories=Category::with('childrenRecursive')->where('parent_id',null)->get();
        return response()->json(['categories'=>$categories],200);
    }

    public function apiIndexAttribute(request $request)
    {
        $categories = $request->all();
        $attributes= AttributeGroup::with('attributeValues','categories')
            ->whereHas('categories',function ($q) use ($categories){
                $q-> whereIn('categories.id',$categories);
            })->get();
        return response()->json(['attributes'=>$attributes],200);
    }
}
