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
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">ایجاد محصول</h3>
            </div>
            @include('admin.partials.form-errors')
            <form class="customform p-3 bg-white" method="post" action="{{route('product.store')}}">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام:</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="name" name="name" placeholder="نام محصول را وارد کنید...">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="slug" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام مستعار :</label>
                    <div class="col-sm-5">
                        <input type="text" rows="10" class="custom-field form-control form-control-sm" id="slug" name="slug" placeholder="نام مستعار محصول را وارد کنید...">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">وضعیت :</label>
                    <div class="col-sm-5 text-right">
                        <input type="radio" name="status" value="0" checked><span class="mr-2 ml-4">عدم انتشار</span>
                        <input type="radio" name="status" value="1"><span class="mr-2"> انتشار</span>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="price" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">قیمت :</label>
                    <div class="col-sm-5">
                        <input type="number" rows="10" class="custom-field form-control form-control-sm" id="price" name="price" placeholder="قیمت محصول را وارد کنید...">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="discount_price" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">قیمت ویژه :</label>
                    <div class="col-sm-5">
                        <input type="number" rows="10" class="custom-field form-control form-control-sm" id="discount_price" name="discount_price" placeholder="قیمت ویژه محصول را وارد کنید...">
                    </div>
                </div>

                <attribute-component :brands="{{ $brands }}"></attribute-component>

                <div class="form-group row d-flex align-items-center">
                    <label for="short_desc" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">توضیحات کوتاه  :</label>
                    <div class="col-sm-5">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription" name="short_desc" placeholder="توضیحات کوتاه محصول را وارد کنید..."></textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="long_desc" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">توضیحات بلند  :</label>
                    <div class="col-sm-5">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm" id="long_desc" name="long_desc" placeholder="توضیحات بلند محصول را وارد کنید..."></textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                    <input type="hidden" name="photo_id[]" id="product-photo">
                    <div class="col-sm-5">
                         <div id="photo" class="dropzone form-control form-control-sm" ></div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="meta_title" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">عنوان سئو :</label>
                    <div class="col-sm-5">
                        <input type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_title" name="meta_title" placeholder="عنوان سئو را وارد کنید...">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="meta_desc" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">توضیحات سئو  :</label>
                    <div class="col-sm-5">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_desc" name="meta_desc" placeholder="توضیحات سئو را وارد کنید..."></textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="meta_keywords" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">کلمات کلیدی سئو :</label>
                    <div class="col-sm-5">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm" id="meta_keywords" name="meta_keywords" placeholder="کلمات کلیدی سئو را وارد کنید..."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn custombutton py-2 px-4 mr-2" onclick="productGallery()">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        Dropzone.autoDiscover = false;
        var photoList = [];
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            url: "{{ route('photo.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                photoList.push(response.photo_id)

            }
        });
        productGallery = function(){
            document.getElementById('product-photo').value = photoList;
        }

        CKEDITOR.replace('textareaDescription',{
            customConfig: 'config.js',
            toolbar: 'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage'
        })
    </script>


@endsection
