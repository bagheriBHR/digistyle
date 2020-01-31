@extends('admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/dropzone.css')}}">
@endsection
@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0" id="app">
        <div class="mb-4">
            <div class="d-flex flex-column">
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal"> ویرایش نظر </h3>
            </div>
            @include('admin.partials.form-errors')
            <form class="customform p-3 bg-white" method="post" action="{{route('comment.update',$comment->id)}}">
                @method('PATCH')
                @csrf
                @csrf

                <div class="form-group row d-flex align-items-center">
                    <label for="short_desc" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">توضیحات :</label>
                    <div class="col-sm-5">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm ckeditor"  id="textareaDescription" name="description" placeholder="توضیحات را وارد کنید...">{{$comment->description}}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn custombutton py-2 px-4 mr-2" onclick="productGallery()">ویرایش</button>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>

        CKEDITOR.replace('textareaDescription',{
            customConfig: 'config.js',
            toolbar: 'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage'
        })
    </script>


@endsection


