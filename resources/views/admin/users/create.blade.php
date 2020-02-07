@extends('admin.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/dropzone.css')}}">
@endsection
@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0" id="app">
        <div class="mb-4 bg-white">
            <div class="d-flex flex-column">
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">ایجاد کاربر</h3>
            </div>
            @include('admin.partials.form-errors')
                <div class="col-md-10 p-0 ">
                    <form class="customform p-3 " method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group row d-flex align-items-center">
                            <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام :</label>
                            <div class="col-sm-4">
                                <input type="text" class="custom-field form-control form-control-sm" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="last_name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام خانوادگی:</label>
                            <div class="col-sm-4">
                                <input type="text" class="custom-field form-control form-control-sm" id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="email" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> ایمیل :</label>
                            <div class="col-sm-4">
                                <input type="text" class="custom-field form-control form-control-sm" id="email" name="email" >
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="phone" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> تلفن :</label>
                            <div class="col-sm-4">
                                <input type="number" class="custom-field form-control form-control-sm" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="national_code" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> کد ملی :</label>
                            <div class="col-sm-4">
                                <input type="number" class="custom-field form-control form-control-sm" id="national_code" name="national_code">
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center ">
                            <label for="roles" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نقش :</label>
                            <div class="col-sm-2 d-flex justify-content-start">
                                <select multiple name="roles[]" class="w-100 custom-field">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="address" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> آدرس :</label>
                            <div class="col-sm-4">
                                <textarea type="text" class="custom-field form-control form-control-sm" id="address" name="address"></textarea>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="company" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نام شرکت :</label>
                            <div class="col-sm-4">
                                <input type="text" class="custom-field form-control form-control-sm" id="company" name="company" >
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="post_code" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> کد پستی :</label>
                            <div class="col-sm-4">
                                <input type="number" class="custom-field form-control form-control-sm" id="post_code" name="post_code" >
                            </div>
                        </div>

                        <province-component></province-component>
                        {{--                        <div class="form-group row d-flex align-items-center">--}}
                        {{--                            <label for="status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت :</label>--}}
                        {{--                            <div class="col-sm-2 d-flex justify-content-start">--}}
                        {{--                                <select name="status" class="w-100 custom-field">--}}
                        {{--                                    <option value="0" >غیر فعال</option>--}}
                        {{--                                    <option value="1" {{$user->status ? "selected" : ""}} > فعال</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-group row d-flex align-items-center">--}}
                        {{--                            <label for="avatar" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">انتخاب تصویر :</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <input type="file" class="form-control form-control-sm border-0" id="avatar" name="avatar" >--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="form-group row d-flex align-items-center">
                            <label for="password" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">رمز عبور :</label>
                            <div class="col-sm-4">
                                <input type="password" class="custom-field form-control form-control-sm" id="password" name="password" >
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                            <input type="hidden" name="photo_id" id="user-photo">
                            <div class="col-sm-5">
                                <div id="photo" class="dropzone form-control form-control-sm" ></div>
                            </div>
                        </div>
                        <button type="submit" class="btn custombutton py-2 px-4 mr-2"> ذخیره</button>
                    </form>
                </div>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            url: "{{ route('photo.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('user-photo').value = response.photo_id
            }
        });
    </script>
@endsection


