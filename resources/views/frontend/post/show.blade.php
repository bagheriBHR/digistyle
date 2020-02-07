@extends('frontend.layout.master')

@section('content')
    <div class="bg-grey d-flex px-3 pt-3 pb-3">
        <!-- right side -->
    @include('frontend.partials.sidebar',['categories'=>$categories])
    <!-- end of right side -->
        <!-- left side -->
        <div class="d-flex justify-content-center">
            <div class="articleShow col-11 d-flex flex-column align-items-center pl-0 bg-white border px-5">

                <!-- Title -->
                <h1 class="mt-4 p-2 pr-3 text-right w-100">{{$post->title}}</h1>
                <!-- Preview Image -->
                <img src="{{$post->photo ? $post->photo->path : "http://www.placehold.it/900x300" }}" class="w-100">
                <hr>
                <div class="info text-right w-100">
                    <!-- Author -->
                    <p >ایجاد شده توسط <a href="#">{{$post->user->name}}</a></p>
                    <!-- Date/Time -->
                    <p>منتشر شده در {{\Hekmatinasser\Verta\Verta::instance($post->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</p>
                </div>
                    <!-- Post Content -->
                <p class="desc text-justify">{!! $post->description !!}</p>

                <hr>
                <div class="comment d-flex flex-column align-items-start w-100 border-top pt-5">

                    <form class="w-50"  method="post" action="">
                        @method('POST')
                        @csrf
                        <div class="d-flex">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control form-control-sm" name="name" placeholder="نام و نام خانوادگی خود را وارد کنید."/>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control form-control-sm" name="email" id="inputAddress" placeholder="پست الکترونیکی خود را وارد کنید."/>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea type="text" rows="10" class="custom-field form-control form-control-sm ckeditor"  id="textareaDescription" name="description" placeholder="نظر خود را وارد کنید..."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn">ارسال</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endsection
