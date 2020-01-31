@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')

    <div class="col-md-10 pb-3 px-0">
        <div class="mb-4">
            <div class="d-flex flex-column">
                <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">ایجاد ویژگی</h3>
            </div>
            @include('admin.partials.form-errors')
            <form class="customform p-3 bg-white" method="post" action="{{route('attributeGroup.store')}}">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">عنوان:</label>
                    <div class="col-sm-5">
                        <input type="text" class="custom-field form-control form-control-sm" id="name" name="name" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="type" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نوع :</label>
                    <div class="col-sm-5">
                        <select name="type" class="custom-field form-control form-control-sm">
                            <option value="select">لیست تکی</option>
                            <option value="multiple">لیست چندتایی</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn custombutton py-2 px-4 mr-2">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
