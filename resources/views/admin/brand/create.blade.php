@extends('admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/dropzone.css')}}">
@endsection
@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')

    <div class="col-md-10 pb-3 px-0" >
        <div class="mb-4">
            <div class="d-flex flex-column">
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">ایجاد مطلب</h3>
            </div>
            @include('admin.partials.form-errors')
            <form class="customform p-3 bg-white" method="post" action="{{route('brand.store')}}">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام:</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="name" name="name" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="desc" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">توضیحات :</label>
                    <div class="col-sm-5">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm" id="desc" name="desc" ></textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                    <input type="hidden" name="photo_id" id="brand-photo">
                    <div class="col-sm-5">
                         <div id="photo" class="dropzone form-control form-control-sm" ></div>
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
                document.getElementById('brand-photo').value = response.photo_id
            }
        });
    </script>
@endsection
