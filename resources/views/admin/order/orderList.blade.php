@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0"  id="app">
        <div class="bg d-flex justify-content-between align-items-center">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">لیست محصولات سفارش  {{$order->id}}</h3>
        </div>
        <table class="customtable w-100 table mb-0 pb-0">
            <thead>
            <tr>
                <th class="text-center" >شماره</th>
                <th class="text-center">تصویر محصول</th>
                <th class="text-center" >نام محصول</th>
                <th class="text-center" >کد محصول</th>
                <th class="text-center" >تعداد</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $key=>$product)
                <tr>
                    <td class="text-center" scope="row">{{convertToPersianNumber($key+1 ) }}</td>
                    <td class="text-center p-0"><img src="{{$product->photos[0]->path}}" style="width:90px !important;"></td>
                    <td class="text-center p-0">{{$product->name}}</td>
                    <td class="text-center p-0">{{$product->sku}}</td>
                    <td class="text-center p-0">{{$product->pivot->QTY}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="bg d-flex justify-content-between align-items-center mt-3">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">مشخصات خریدار محصول </h3>
        </div>
        <div class="userInfo d-flex flex-column align-items-center mt-2">
            <ul class="list-group list-group-horizontal-xl mt-2 w-75">
                <li class="list-group-item w-25 text-right font-weight-bold">نام خریدار:</li>
                <li class="list-group-item w-50 text-right">{{$order->user->name . ' ' . $order->user->last_name}}</li>
            </ul>
            <ul class="list-group list-group-horizontal-xl mt-2 w-75">
                <li class="list-group-item w-25 text-right font-weight-bold">آدرس خریدار:</li>
                <li class="list-group-item w-50 text-right">{{$order->user->addresses[0]->province->name . ' ' . $order->user->addresses[0]->city->name . ' ' . $order->user->addresses[0]->address}}</li>
            </ul>
            <ul class="list-group list-group-horizontal-xl mt-2 w-75">
                <li class="list-group-item w-25 text-right font-weight-bold">کد پستی خریدار:</li>
                <li class="list-group-item w-50 text-right"> {{$order->user->addresses[0]->post_code}}</li>
            </ul>
            <ul class="list-group list-group-horizontal-xl mt-2 w-75">
                <li class="list-group-item w-25 text-right font-weight-bold">شماره موبایل خریدار:</li>
                <li class="list-group-item w-50 text-right"> {{$order->user->phone}}</li>
            </ul>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/app.js')}}"></script>
@endsection

