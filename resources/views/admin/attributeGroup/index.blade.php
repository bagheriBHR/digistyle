@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0">
        <div class="bg d-flex justify-content-between align-items-center">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">اطلاعات ویژگی ها</h3>
            <a href="{{route('attributeGroup.create')}}" class="pl-3 add"><i class="fa fa-plus ml-2"></i>اضافه کردن</a>
        </div>
        @if(Session::has('attribute_delete'))
            <div class="alert alert-danger text-right">
                <div>{{Session('attribute_delete')}}</div>
            </div>
        @endif
        @if(Session::has('attribute'))
            <div class="alert alert-success text-right">
                <div>{{Session('attribute')}}</div>
            </div>
        @endif
        <table class="customtable w-100 table mb-0 pb-0">
            <thead>
            <tr>
                <th class="text-right" >شماره</th>
                <th class="text-right">نام </th>
                <th class="text-right">نوع </th>
                <th class="text-center" >زمان ایجاد</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($attributeGroups as $key=>$attributeGroup)
                <tr>
                    <td class="text-right" scope="row">{{convertToPersianNumber($key+1 ) }}</td>
                    <td class="text-right p-0">{{ $attributeGroup->name }}</td>
                    <td class="text-right p-0">{{ $attributeGroup->type }}</td>
                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($attributeGroup->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
                    <td class=" border-0 p-0">
                        <a href="{{route('attributeGroup.edit',$attributeGroup->id)}}" class="btn editbtn"><img src="{{asset('img/edit.png')}}" alt="" class="ml-2 moveFade">ویرایش کردن</a>
                    </td>
                    <td class="border-0 p-0">
                        <form action="{{route('attributeGroup.destroy',$attributeGroup->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn dropbtn"><img src="{{asset('img/delete.png')}}" alt="" class="ml-2 moveFade">حذف کردن</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-12 mt-3 d-flex justify-content-center">{{$attributeGroups->links()}}</div>
    </div>
@endsection
