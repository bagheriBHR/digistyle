@extends('frontend.layout.master')


@section('content')

    <div class="container">
        @if(Session::has('error'))
            <div class="alert alert-warning">
                <div>{{session('error')}}</div>
            </div>
        @endif
        @if(Session::has('warning'))
            <div class="alert alert-warning text-right">
                <div>{{session('warning')}}</div>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success">
                <div>{{session('success')}}</div>
            </div>
        @endif
        @include('admin.partials.form-errors')
    <!-- Breadcrumb Start-->
        <!-- Breadcrumb End-->
        <div class="row text-right">
            <!--Middle Part Start-->
            <div class="col-sm-12">
                <h1 class="title">سبد خرید</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center" width="9%">تصویر</td>
                            <td class="text-right">نام محصول</td>
                            <td class="text-right">کد محصول</td>
                            <td class="text-right">تعداد</td>
                            <td class="text-right">قیمت واحد</td>
                            <td class="text-right">کل</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->items as $product)
                            <tr>
                                <td class="text-center" width="9%"><a href="#"><img src="{{$product['item']->photos[0]->path}}" class="img-thumbnail" /></a></td>
                                <td class="text-right"><a href="#">{{$product['item']->name}}</a><br />
                                <td class="text-right">{{$product['item']->sku}}</td>
                                <td class="text-right">
                                    <div class="input-group text-center">
                                        <a class="btn btn-success" data-toggle="tooltip" title="اضافه"  href="{{route('cart.add', ['id' => $product['item']->id])}}"><i class="fa fa-plus"></i></a>
                                        <p class="text-center mx-2" style="margin-top: 10px;">{{$product['qty']}}</p>
                                        <button type="button" data-toggle="tooltip" title="کم" class="btn btn-danger" onclick="event.preventDefault();
                                            document.getElementById('remove-cart-item_{{$product['item']->id}}').submit();"><i class="fa fa-minus"></i></button>
                                        <form id="remove-cart-item_{{$product['item']->id}}" action="{{ route('cart.remove', ['id' => $product['item']->id]) }}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                                <td class="text-right">{{$product['item']->discount_price ? $product['item']->discount_price : $product['item']->price }} تومان</td>
                                <td class="text-right">{{$product['price']}} تومان</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 class="subtitle">حالا مایلید چه کاری انجام دهید؟</h2>
                <p>در صورتی که کد تخفیف در اختیار دارید میتوانید از آن در اینجا استفاده کنید.</p>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title p-0">استفاده از کوپن تخفیف</h6>
                            </div>
{{--                            <div id="collapse-coupon" class="panel-collapse collapse in">--}}
                                <div class="card-body p-2">
                                    <label class="col-sm-4 control-label" for="input-coupon">کد تخفیف خود را در اینجا وارد کنید</label>
                                    <form action="{{ route('coupon.add') }}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="code" placeholder="کد تخفیف خود را در اینجا وارد کنید" class="form-control" />
                                            <span class="input-group-btn">
                                                <button type="submit"
                                                        class="btn gold-btn" >اعمال کوپن</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                {{--<div class="col-sm-6">--}}
                {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">استفاده از کارت هدیه</h4>--}}
                {{--</div>--}}
                {{--<div id="collapse-voucher" class="panel-collapse collapse in">--}}
                {{--<div class="panel-body">--}}
                {{--<label class="col-sm-4 control-label" for="input-voucher">کد کارت هدیه را در اینجا وارد کنید</label>--}}
                {{--<div class="input-group">--}}
                {{--<input type="text" name="voucher" value="" placeholder="کد کارت هدیه را در اینجا وارد کنید" id="input-voucher" class="form-control" />--}}
                {{--<span class="input-group-btn">--}}
                {{--<input type="submit" value="اعمال کارت هدیه" id="button-voucher" data-loading-text="بارگذاری ..."  class="btn btn-primary" />--}}
                {{--</span> </div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="d-flex flex-column align-content-between w-100">
                <div class=" mt-3 buttons d-flex justify-content-center">
                    <div class="col-sm-6 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right"><strong>جمع کل</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPurePrice}} تومان</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>تخفیف</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalDiscountPrice}} تومان</td>
                            </tr>
                            @if(Auth::check() && Session::get('cart')->coupon)
                                <tr>
                                    <td class="text-right"><strong>{{Session::get('cart')->coupon['coupon']->title}}</strong></td>
                                    <td class="text-right">{{Session::get('cart')->couponDiscount}} تومان</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="text-right"><strong>قابل پرداخت</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPrice}} تومان</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="buttons w-100">
                    <div class="pull-left"><a href="{{url('/')}}" class="btn btn-info">ادامه خرید</a></div>
                    <div class="pull-right"><a href="{{route('order.verify')}}" class="btn gold-btn">تسویه حساب</a></div>
                </div>
            </div>
        </div>
        <!--Middle Part End -->
    </div>
    </div>

@endsection
