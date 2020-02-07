@extends('frontend.layout.master')

@section('content')
    <div class="container" >
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
            </div>
            <!--Middle Part End -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
