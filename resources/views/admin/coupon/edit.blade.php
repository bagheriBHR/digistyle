@extends('admin.layouts.master')
@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')

    <div class="col-md-10 pb-3 px-0">
        <div class="mb-4">
            <div class="d-flex flex-column">
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">ویرایش کد تخفیف</h3>
            </div>
            @include('admin.partials.form-errors')
            <form class="customform p-3 bg-white" method="post" action="{{route('coupon.update',$coupon->id)}}">
                @method('PATCH')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">عنوان کد تخفیف:</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="title" name="title" value="{{$coupon->title}}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="code" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">کد :</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="code" name="code" value="{{$coupon->code}}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="price" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">قیمت :</label>
                    <div class="col-sm-5">
                        <input type="number" class="custom-field form-control form-control-sm" id="price" name="price" value="{{$coupon->price}}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">وضعیت :</label>
                    <div class="col-sm-5 text-right">
                        <input type="radio" name="status" value="0" @if($coupon->status == 0) checked @endif><span class="mr-2 ml-4">عدم انتشار</span>
                        <input type="radio" name="status" value="1" @if($coupon->status == 1) checked @endif><span class="mr-2"> انتشار</span>
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

