<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('css/all-admin.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('fonts/font-face.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts-awesome/css/font-awesome.min.css') }}">
{{--    <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/skins/_all-skins.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="{{asset('ionicons/css/ionicons.min.css')}}">

{{--    <link rel="stylesheet" href="{{asset('/plugins/iCheck/flat/blue.css')}}">--}}
{{--    <!-- Morris chart -->--}}
{{--    <link rel="stylesheet" href="{{asset('/plugins/morris/morris.css')}}">--}}
{{--    <!-- jvectormap -->--}}
{{--    <link rel="stylesheet" href="{{asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">--}}
{{--    <!-- Date Picker -->--}}
{{--    <link rel="stylesheet" href="{{asset('/plugins/datepicker/datepicker3.css')}}">--}}
{{--    <!-- Daterange picker -->--}}
{{--    <link rel="stylesheet" href="{{asset('/plugins/daterangepicker/daterangepicker-bs3.css')}}">--}}
{{--    <!-- bootstrap wysihtml5 - text editor -->--}}
{{--    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">--}}
{{--    <!-- jQuery 2.2.0 -->--}}
{{--    <script src="{{asset('/plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>--}}

    <title>Document</title>
    @yield('style')
</head>
<body>
<div class="header">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mx-5">
        <h1 class="font-weight-normal py-2"><a href="{{route('main.index')}}">پنل مدیریت</a></h1>
        <div class="d-flex align-items-center">
            <h3 class="font-weight-normal m-0">خوش آمدید،</h3>
            {{--            <h3 class="font-weight-normal m-0 pr-1">نام کاربر.</h3>--}}
            <h3  class="font-weight-normal m-0 pr-1 pl-3" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
{{--                {{ Auth::user()->name }}--}}
                <span class="caret"></span>
            </h3>
            <ul class="nav p-0">
                <li class=" py-0"><a href=""> نمایش وبگاه</a><span class="text-white mx-1">/</span></li>
                <li class=" py-0"><a href="#">تغییر گذرواژه</a><span class="text-white mx-1">/</span></li>
                {{--                <li class="py-0"><a href="#">خروج</a></li>--}}
                <li class="py-0">
                    <a  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('خروج') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            {{--            <ul class="navbar-nav ml-auto">--}}
            {{--                <!-- Authentication Links -->--}}
            {{--                @guest--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
            {{--                    </li>--}}
            {{--                    @if (Route::has('register'))--}}
            {{--                        <li class="nav-item">--}}
            {{--                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
            {{--                        </li>--}}
            {{--                    @endif--}}
            {{--                @else--}}
            {{--                    <li class="nav-item dropdown">--}}
            {{--                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
            {{--                            {{ Auth::user()->name }} <span class="caret"></span>--}}
            {{--                        </a>--}}

            {{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
            {{--                            <a class="dropdown-item" href="{{ route('logout') }}"--}}
            {{--                               onclick="event.preventDefault();--}}
            {{--                                                     document.getElementById('logout-form').submit();">--}}
            {{--                                {{ __('Logout') }}--}}
            {{--                            </a>--}}

            {{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
            {{--                                @csrf--}}
            {{--                            </form>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}
            {{--                @endguest--}}
            {{--            </ul>--}}
        </div>
    </div>
</div>

<div class="main d-flex flex-column align-items-start mx-4">
    <h2 class="py-3 font-weight-normal">مدیریت وب گاه</h2>
    <div class="d-flex w-100">
        @yield('sidebar')
        @yield('content')
    </div>
</div>


<script src="{{asset('js/libs/jquery.min.js')}}"></script>
<script src="{{asset('frontend/bootstrap/js/bootstrap.min.js')}}"></script>
@yield('script')
</body>
</html>


