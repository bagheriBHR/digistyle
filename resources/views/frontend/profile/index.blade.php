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
                <div class="alert alert-success text-right">
                    <p>{{$user->name . ' ' . $user->last_name}} به حساب کاربری خود خوش آمدید</p>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
