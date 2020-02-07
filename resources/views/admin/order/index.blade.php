@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0"  id="app">
        <div class="bg d-flex justify-content-between align-items-center">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">اطلاعات سفارشات  </h3>
        </div>
        <table class="customtable w-100 table mb-0 pb-0">
            <thead>
            <tr>
                <th class="text-center" >شماره</th>
                <th class="text-center" >مبلغ</th>
                <th class="text-center" >وضعیت</th>
                <th class="text-center" >زمان ایجاد</th>
                <th class="text-center" ></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $key=>$order)
                <tr>
                    <td class="text-center" scope="row">{{convertToPersianNumber($key+1 ) }}</td>
                    <td class="text-center p-0">{{ $order->amount }}</td>
                    @if($order->status == 0)
                        <td class="text-center"><span class="bg-danger text-light p-1">پرداخت نشده</span></td>
                    @else
                        <td class="text-center"><span class="bg-success text-light p-1">پرداخت شده</span></td>
                    @endif
                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($order->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
                    <td class="text-center p-0"><a href="{{route('order.list',['id'=>$order->id])}}"><label class="btn btn-info text-white mb-0">مشاهده جزئیات</label></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-12 mt-3 d-flex justify-content-center">{{$orders->links()}}</div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/app.js')}}"></script>
@endsection

