@extends('frontend.layout.master')

@section('content')
    <div class="bg-grey d-flex flex-column align-items-center px-3 pt-3 pb-3">
        <!-- left side -->
        <div class="col-10 d-flex flex-column">
            @if(Session::has('success'))
                <div class="alert alert-success text-right">
                    <div>{{session('success')}}</div>
                </div>
            @endif

            <div class=" d-flex justify-content-center stuff py-3 border-stuff mb-5 bg-white">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9 text-right">
{{--                <h1 class="title my-3">حساب کاربری ورود</h1>--}}
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="subtitle" >مشتری جدید</h2>
                        <p><strong>ثبت نام حساب کاربری</strong></p>
                        <p>با ایجاد حساب کاربری میتوانید سریعتر خرید کرده، از وضعیت خرید خود آگاه شده و تاریخچه ی سفارشات خود را مشاهده کنید.</p>
                        <a href="{{route('user.register')}}" class="btn btn-gold">ادامه</a> </div>
                    <div class="col-sm-6">
                        <h2 class="subtitle">مشتری قبلی</h2>
                        <p><strong>من از قبل مشتری شما هستم</strong></p>
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="input-email">آدرس ایمیل</label>
                                <input type="text" name="email" value="" placeholder="آدرس ایمیل" id="input-email" class="form-control" />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-password">رمز عبور</label>
                                <input type="password" name="password" value="" placeholder="رمز عبور" id="input-password" class="form-control" />
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <br />
                                <a class="gold" href="#">فراموشی رمز عبور</a></div>
                            <input type="submit" value="ورود" class="btn btn-gold mb-3" />
                        </form>

                    </div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
        </div>
    </div>
@endsection

