@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0" >
        <div class="bg d-flex justify-content-between align-items-center">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">اطلاعات دسته بندی</h3>
            <a href="{{route('category.create')}}" class="pl-3 add"><i class="fa fa-plus ml-2"></i>اضافه کردن</a>
        </div>
        @if(Session::has('category_delete'))
            <div class="alert alert-danger text-right">
                <div>{{Session('category_delete')}}</div>
            </div>
        @endif
        @if(Session::has('error_category'))
            <div class="alert alert-danger text-right">
                <div>{{Session('error_category')}}</div>
            </div>
        @endif
        @if(Session::has('category_add'))
            <div class="alert alert-success text-right">
                <div>{{Session('category_add')}}</div>
            </div>
        @endif
        @if(Session::has('category_update'))
            <div class="alert alert-success text-right">
                <div>{{Session('category_update')}}</div>
            </div>
        @endif
        <table class="customtable w-100 table mb-0 pb-0">
            <thead>
            <tr>
{{--                <th class="text-right" >شماره</th>--}}
                <th class="text-right pr-5">نام </th>
                <th class="text-right" >زمان ایجاد</th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key=>$category)
                <tr>
{{--                    <td class="text-right" scope="row">{{convertToPersianNumber($category->id ) }}</td>--}}
                    <td class="text-right pr-5">{{ $category->name }}</td>
                    <td class="text-right p-0">{{\Hekmatinasser\Verta\Verta::instance($category->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
                    <td class=" border-0 p-0">
                        <a href="{{route('category.edit',$category->id)}}" class="btn editbtn"><img src="{{asset('img/edit.png')}}" alt="" class="ml-2 moveFade">ویرایش کردن</a>
                    </td>
                    <td class="border-0 p-0">
                        <form action="{{route('category.destroy',$category->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn dropbtn"><img src="{{asset('img/delete.png')}}" alt="" class="ml-2 moveFade">حذف کردن</button>
                        </form>
                    </td>
                    <td class=" border-0 p-0">
                        <a href="{{route('category.createSetting',$category->id)}}" class="btn editbtn"><img src="{{asset('img/add.png')}}" alt="" class="ml-2 moveFade">افزودن ویژگی </a>
                    </td>
                </tr>
                @if(count($category->childrenRecursive) > 0)
                    @include('admin.partials.category',['categories'=>$category->childrenRecursive,'level'=>1])
                @endif
            @endforeach
            </tbody>
        </table>
        <div class="col-md-12 mt-3 d-flex justify-content-center">{{$categories->links()}}</div>
    </div>
@endsection
