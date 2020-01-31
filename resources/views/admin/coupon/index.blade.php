@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0">
        <div class="bg d-flex justify-content-between align-items-center">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">اطلاعات کد تخفیف  </h3>
            <a href="{{route('coupon.create')}}" class="pl-3 add"><i class="fa fa-plus ml-2"></i>اضافه کردن</a>
        </div>
        @if(Session::has('delete'))
            <div class="alert alert-danger text-right">
                <div>{{Session('delete')}}</div>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success text-right">
                <div>{{Session('success')}}</div>
            </div>
        @endif
        <table class="customtable w-100 table mb-0 pb-0">
            <thead>
            <tr>
                <th class="text-center" >شماره</th>
                <th class="text-center" >عنوان</th>
                <th class="text-center">کد</th>
                <th class="text-center">قیمت</th>
                <th class="text-center">وضعیت</th>
                <th class="text-center" >زمان ایجاد</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($coupons as $key=>$coupon)
                <tr>
                    <td class="text-center" scope="row">{{convertToPersianNumber($key+1 ) }}</td>
                    <td class="text-center p-0">{{ $coupon->title }}</td>
                    <td class="text-center p-0">{{ $coupon->code }}</td>
                    <td class="text-center p-0">{{ $coupon->price }}</td>
                    @if($coupon->status == 0)
                        <td class="text-center"><span class="tag tag-pill tag-danger">غیر فعال</span></td>
                    @else
                        <td class="text-center"><span class="tag tag-pill tag-success">فعال</span></td>
                    @endif
                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($coupon->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
                    <td class=" border-0 p-0">
                        <a href="{{route('coupon.edit',$coupon->id)}}" class="btn editbtn"><img src="{{asset('img/edit.png')}}" alt="" class="ml-2 moveFade">ویرایش کردن</a>
                    </td>
                    <td class="border-0 p-0">
                        <form action="{{route('coupon.destroy',$coupon->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn dropbtn"><img src="{{asset('img/delete.png')}}" alt="" class="ml-2 moveFade">حذف کردن</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
{{--        <div class="col-md-12 mt-3 d-flex justify-content-center">{{$brands->links()}}</div>--}}
    </div>
@endsection

