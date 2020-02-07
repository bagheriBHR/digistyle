@extends('frontend.layout.master')
@section('style')
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
@endsection
@section('content')
    <div  id="app">
        <product-component :category="{{$category}}" :brands="{{$brands}}"></product-component>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
{{--    <script>--}}
{{--        // var elements = document.getElementsByClassName("viewType");--}}
{{--        //--}}
{{--        // // Declare a loop variable--}}
{{--        // var i;--}}
{{--        //--}}
{{--        // // List View--}}
{{--        // function listView() {--}}
{{--        //     for (i = 0; i < elements.length; i++) {--}}
{{--        //         elements[i].style.width = "100%";--}}
{{--        //     }--}}
{{--        // }--}}
{{--        //--}}
{{--        // // Grid View--}}
{{--        // function gridView() {--}}
{{--        //     for (i = 0; i < elements.length; i++) {--}}
{{--        //         elements[i].style.width = "50%";--}}
{{--        //     }--}}
{{--        // }--}}

{{--    // </script>--}}
@endsection

