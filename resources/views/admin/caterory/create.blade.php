@extends('admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/dropzone.css')}}">
@endsection
@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')

    <div class="col-md-10 pb-3 px-0">
        <div class="mb-4">
            <div class="d-flex flex-column">
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">ایجاد دسته بندی</h3>
            </div>
            @include('admin.partials.form-errors')
            <form class="customform p-3 bg-white" method="post" action="{{route('category.store')}}">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">عنوان:</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="name" name="name" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="slug" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام مستعار:</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="slug" name="slug" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="parent_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته والد :</label>
                    <div class="col-sm-5">
                        <select name="parent_id" class="custom-field form-control form-control-sm">
                            <option value="">بدون والد</option>
                            @foreach($categories as $category_list)
                                <option value="{{$category_list->id}}">{{$category_list->name}}</option>
                                @if(count($category_list->childrenRecursive)>0)
                                    @include('admin.partials.category_list',['categories'=>$category_list->childrenRecursive,'level'=>1])
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                    <input type="hidden" name="photo_id" id="category-photo">
                    <div class="col-sm-5">
                        <div id="photo" class="dropzone form-control form-control-sm" ></div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="meta_title" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">عنوان سئو:</label>
                    <div class="col-sm-5">
                        <input type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_title" name="meta_title" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="meta_desc" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">توضیحات سئو :</label>
                    <div class="col-sm-5">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_desc" name="meta_desc" ></textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="meta_keywords" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">کلمات کلیدی سئو:</label>
                    <div class="col-sm-5">
                        <input type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_keywords" name="meta_keywords" >
                    </div>
                </div>
                <button type="submit" class="btn custombutton py-2 px-4 mr-2">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            url: "{{ route('photo.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('category-photo').value = response.photo_id
            }
        });
    </script>
@endsection
