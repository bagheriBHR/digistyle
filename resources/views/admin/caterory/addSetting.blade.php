@extends('admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('css/BsMultiSelect.min.css')}}">
@endsection
@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')

    <div class="col-md-10 pb-3 px-0">
        <div class="mb-4">
            <div class="d-flex flex-column">
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">افزودن ویژگی به دسته بندی {{$category->name}}</h3>
            </div>
            @include('admin.partials.form-errors')
            <form class="customform p-3 bg-white" method="post" action="{{route('category.addSetting',$category->id)}}">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام:</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="name" name="name" value="{{$category->name}}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="attributeGroup_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته والد :</label>
                    <div class="col-sm-5">
{{--                        <select name="attributeGroup_id[]" id="multiselect" style="display: none" class="custom-field form-control form-control-sm" multiple>--}}
                        <select name="attributeGroup_id[]" id="multiselect" class="custom-field form-control form-control-sm" multiple>
                            @foreach($attributeGroup as $attr)
                                <option value="{{$attr->id}}" @if(in_array($attr->id, $category->attributeGroups->pluck('id')->toArray())) selected @endif>{{$attr->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn custombutton py-2 px-4 mr-2">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('/js/BsMultiSelect.min.js')}}"></script>
    <script>
        $("#multiselect").bsMultiSelect();
    </script>
@endsection
