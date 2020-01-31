<?php

namespace App\Http\Controllers\Admin;

use App\AttributeGroup;
use App\Http\Controllers\Controller;

use App\AttributeValue;
use App\Http\Requests\AttributeValueRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeValues=AttributeValue::with('attributeGroup')->paginate(10);
        return view('admin.attributeValue.index',compact(['attributeValues']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributeGroups=AttributeGroup::all();
        return view('admin.attributeValue.create',compact(['attributeGroups']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeValueRequest $request)
    {
        $attribute=new AttributeValue();
        $attribute->name = $request->name;
        $attribute->attributeGroup_id = $request->attributeGroup_id;
        $attribute->save();
        Session::flash('attribute', 'مقدار ویژگی با موفقیت درج گردید.');
        return redirect()->route('attributeValue.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $attributeValue=AttributeValue::with('attributeGroup')->whereId($id)->first();
        $attributeGroups=AttributeGroup::all();
        return view('admin.attributeValue.edit',compact(['attributeValue','attributeGroups']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeValueRequest $request, $id)
    {
        $attribute=AttributeValue::find($id);
        $attribute->name = $request->name;
        $attribute->attributeGroup_id = $request->attributeGroup_id;
        $attribute->save();
        Session::flash('attribute', 'مقدار ویژگی با موفقیت بروزرسانی گردید.');
        return redirect()->route('attributeValue.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeValue=AttributeValue::find($id)->delete();
        Session::flash('attribute_delete', 'مقدار ویژگی با موفقیت حذف گردید.');
        return redirect()->route('attributeValue.index');

    }
}
