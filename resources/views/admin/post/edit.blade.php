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
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">تغییر مطلب</h3>
            </div>
            @include('admin.partials.form-errors')
            <div class="d-flex bg-white">
                <div class="col-md-2 mt-3">
                    <img src="{{$post->photo ? $post->photo->path : 'http://www.placehold.it/400'}}" alt="" class="img-fluid">
                </div>
                <div class="col-md-10 p-0">
                     <form class="customform p-3 " method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
                         @method('PATCH')
                        @csrf
                         <div class="form-group row d-flex align-items-center">
                             <label for="title" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">عنوان:</label>
                             <div class="col-sm-5">
                                 <input type="text" class="custom-field form-control form-control-sm" id="title" name="title"  value="{{$post->title}}">
                             </div>
                         </div>
                         <div class="form-group row d-flex align-items-center">
                             <label for="slug" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نام مستعار :</label>
                             <div class="col-sm-5">
                                 <input type="text" class="custom-field form-control form-control-sm" id="slug" name="slug"  value="{{$post->slug}}">
                             </div>
                         </div><div class="form-group row d-flex align-items-center">
                             <label for="description" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> توضیحات:</label>
                             <div class="col-sm-5">
                                 <textarea type="text" class="custom-field form-control form-control-sm ckeditor" rows="10" id="textareaDescription" name="description" >{{$post->description}}</textarea>
                             </div>
                         </div>
                         <div class="form-group row d-flex align-items-center ">
                             <label for="category" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته بندی :</label>
                             <div class="col-sm-5 d-flex justify-content-start">
                                 <select name="category" class="w-100 custom-field">
                                     <option>انتخاب کنید...</option>
                                     @foreach($categories as $category_list)
                                         <option value="{{$category_list->id}}" {{$post->category_id == $category_list->id ? 'selected':''}}>{{$category_list->name}}</option>
                                         @if(count($category_list->childrenRecursive)>0)
                                             @include('admin.partials.category_list',['categories'=>$category_list->childrenRecursive,'level'=>1,'category'=>$post->category->id])
                                         @endif
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="form-group row d-flex align-items-center">
                             <label for="status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت :</label>
                             <div class="col-sm-5 d-flex justify-content-start">
                                 <select name="status" class="w-100 custom-field">
                                     <option value="0" @if($post->status==0) selected @endif>غیر فعال</option>
                                     <option value="1" @if($post->status==1) selected @endif> فعال</option>
                                 </select>
                             </div>
                         </div>
                         <div class="form-group row d-flex align-items-center">
                             <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                             <input type="hidden" name="photo_id" id="post-photo" value="{{$post->photo_id}}">
                             <div class="col-sm-5">
                                 <div id="photo" class="dropzone form-control form-control-sm" ></div>
                             </div>
                         </div>
                         <div class="form-group row d-flex align-items-center">
                             <label for="meta_description" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">متا توضیحات :</label>
                             <div class="col-sm-5">
                                 <textarea type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_description" name="meta_description" >{{$post->meta_description}}</textarea>
                             </div>
                         </div>
                         <div class="form-group row d-flex align-items-center">
                             <label for="meta_keywords" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">متا برچسب ها :</label>
                             <div class="col-sm-5">
                                 <textarea type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_keywords" name="meta_keywords" >{{$post->meta_description}}</textarea>
                             </div>
                         </div>
                         <button type="submit" class="btn custombutton py-2 px-4 mr-2">ذخیره</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            url: "{{ route('photo.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('post-photo').value = response.photo_id
            }
        });
        CKEDITOR.replace('textareaDescription',{
            customConfig: 'config.js',
            toolbar: 'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage'
        })
    </script>
@endsection
