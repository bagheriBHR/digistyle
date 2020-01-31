<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\AttributeGroup;
use App\Http\Requests\AttributeGroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeGroups=AttributeGroup::paginate(10);
        return view('admin.attributeGroup.index',compact(['attributeGroups']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributeGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeGroupRequest $request)
    {
        $attribute=new AttributeGroup();
        $attribute->name=$request->name;
        $attribute->type=$request->type;
        $attribute->save();
        Session::flash('attribute','ویژگی با موفقیت اضافه شد.');
        return redirect()->route('attributeGroup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeGroup $attributeGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributeGroup=AttributeGroup::find($id);
        return view('admin.attributeGroup.edit',compact(['attributeGroup']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeGroupRequest $request, $id)
    {
        $attribute=AttributeGroup::find($id);
        $attribute->name=$request->name;
        $attribute->type=$request->type;
        $attribute->save();
        Session::flash('attribute','ویژگی با موفقیت ویرایش شد.');
        return redirect()->route('attributeGroup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeGroup=AttributeGroup::find($id);
        $attributeGroup->delete();
        Session::flash('attribute_delete', 'ویژگی با موفقیت حذف گردید.');
        return redirect()->route('attributeGroup.index');
    }
}
