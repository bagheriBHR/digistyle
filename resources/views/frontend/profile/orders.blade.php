@extends('frontend.layout.master')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success text-right">
                <div>{{session('success')}}</div>
            </div>
        @endif
            <div class="mytextdiv d-flex flex-row align-items-center justify-content-start mb-3">
                <div class="mytexttitle mt-3">
                    <h3 class="ml-2 mb-0 pr-2">حساب کاربری</h3>
                </div>
                <div class="divider mt-5"></div>
            </div>
        <div class="row" id="app">
             <profile-component></profile-component>
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <table class="table table-striped">
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
                            <td class="text-center p-0"><a href="{{route('profile.order.list',['id'=>$order->id])}}"><label class="btn btn-info text-white mb-0">مشاهده جزئیات</label></a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
