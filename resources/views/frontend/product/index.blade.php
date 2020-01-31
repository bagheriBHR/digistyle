@extends('frontend.layout.master')

@section('style')
    <link href="{{asset('frontend/style.css')}}">
@endsection
@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success text-right">
                <div>{{Session('success')}}</div>
            </div>
        @endif
        <div class="stuff d-flex flex-column flex-md-row py-3 border-stuff my-5 bg-white">
            <div class="col-12 col-md-6 d-flex border-left p-0">
                    <div class="icon mr-2 d-flex flex-row flex-md-column justify-content-center">
                        <img src="/frontend/img/icons8-heart-5022.png" alt="" class=" mb-3" title="">
                        <img src="/frontend/img/stuff/icons8-share-50.png" alt="" class=" mb-3" title="اشتراک گذاری">
                        <img src="/frontend/img/stuff/icons8-scatter-plot-50.png" alt="" class=" mb-3" title="نمودار قیمت">
                        <img src="/frontend/img/stuff/icons8-compare-2.png" alt="" class=" mb-3" title="مقایسه">
                    </div>
                    <div class="d-flex flex-column align-items-center w-100 mx-3">
                        <img class="img-fluid" id="zoom_01" src="{{$product->photos[0]->path}}"  data-zoom-image="{{$product->photos[0]->path}}" />
                        <div class="text-center mt-2">
                            <span class="zoom-gallery font-weight-bold"><i class="fa fa-search"></i> برای مشاهده گالری روی تصویر کلیک کنید</span>
                        </div>
                        <div class="d-flex p-0 mt-2" id="gallery_01">
                            @foreach($product->photos as $photo)
                                <a class="nav-link" href="#" data-zoom-image="{{$photo->path}}" data-image="{{$photo->path}}">
                                    <img src="{{$photo->path}}"/>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            <div class=" col-12 col-md-6 d-flex flex-column mt-3">
                     <div class="info d-flex flex-column align-items-start w-100 pb-2">
                           <h3 class="mb-4">{{$product->name}}</h3>
                            <div class="d-flex flex-row">
                                <h4 class="ml-4">دسته : <span>{{$product->categories[0]->name}}</span></h4>
                                <h4>برند : <span>{{$product->brand->name}}</span></h4>
                            </div>
                            <div class="d-flex my-2">
                                <h4 class="mb-0">کد محصول : </h4>
                                <span class="mr-2">{{$product->sku}}</span>
                            </div>
                     </div>
    {{--            <div class="color d-flex flex-row align-items-center mt-3">--}}
    {{--                <h4 class="mb-0">انتخاب رنگ : </h4>--}}
    {{--                <div class="mx-2"></div>--}}
    {{--                <h5 class="mb-0">فیروزه ای</h5>--}}
    {{--            </div>--}}
                    <div class="price d-flex flex-column justify-content-center">
                        <div class="d-flex mt-4">
                            <h4 class="mb-0">قیمت :  </h4>
                            @if($product->discount_price)
                                <p class="price mb-0 mr-2"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->price}} تومان</span></p>
                            @else
                                <h5 class="mb-0 mr-2">تومان {{$product->price}}</h5>
                            @endif
                        </div>
                        <div class=" d-flex align-items-center justify-content-end mt-4">
        {{--                    <button class="btn py-1">+</button>--}}
        {{--                    <input type="text" value="1" class="form-control form-control-sm py-0 my-0">--}}
        {{--                    <button class="btn py-1">-</button>--}}
                            <a href="{{route('cart.add', ['id' => $product->id])}}" class="shopping btn mr-4 py-1"><i class="fa fa-shopping-cart ml-2"></i>افزودن به سبد خرید</a>
                        </div>
                    </div>
                    <div class="properties d-flex flex-column text-right mt-4 pt-3">
                        <h4>ویژگی های محصول</h4>
                        <ul class="pr-4">
                            @foreach($product->attributeValues as $item)
                                 <li>{{$item->attributeGroup->name}} : {{$item->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <form class="form-horizontal poststars" action="{{route('productStar', $product->id)}}" id="addStar" method="post">
                        @method('POST')
                        @csrf
                        <div class="form-group required">
                            <div class="col-sm-12 text-right">
                                <label class="title">امتیاز شما : </label>
                                @if(!$productRating->rating->isEmpty())
                                    <input class="star star-5" value="5" id="star-5" type="radio" name="star" @if($productRating->rating[0]->rating == 5) checked @endif/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" value="4" id="star-4" type="radio" name="star" @if($productRating->rating[0]->rating == 4) checked @endif/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" value="3" id="star-3" type="radio" name="star" @if($productRating->rating[0]->rating == 3) checked @endif/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" value="2" id="star-2" type="radio" name="star" @if($productRating->rating[0]->rating == 2) checked @endif/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" value="1" id="star-1" type="radio" name="star" @if($productRating->rating[0]->rating == 1) checked @endif/>
                                    <label class="star star-1" for="star-1"></label>
                                    @else
                                    <input class="star star-5" value="5" id="star-5" type="radio" name="star" />
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" value="4" id="star-4" type="radio" name="star" />
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" value="3" id="star-3" type="radio" name="star" />
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" value="2" id="star-2" type="radio" name="star" />
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" value="1" id="star-1" type="radio" name="star" />
                                    <label class="star star-1" for="star-1"></label>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="stuffservice d-flex align-items-center justify-content-center mt-3 ">
                    <div class="d-flex flex-column flex-md-row justify-content-around container mt-3">
                        <div class=" d-flex flex-column align-items-center justify-content-center">
                            <img src="/frontend/img/icons8-return-purchase-50.png" alt="" class="">
                            <h3 class="my-1">ضمانت بازگشت کالا</h3>
                            <h4>به مدت 10 روز</h4>
                        </div>
                        <div class=" d-flex flex-column align-items-center justify-content-center">
                            <img src="/frontend/img/icons8-quality-50.png" alt="" class=" ">
                            <h3 class="my-1">ضمانت اصالت و کیفیت</h3>
                            <h4>دست سازه های ایرانی</h4>
                        </div>
                        <div class=" d-flex flex-column align-items-center justify-content-center">
                            <img src="/frontend/img/icons8-delivery-50.png" alt="" class=" p-1">
                            <h3 class="my-1">ارسال سریع</h3>
                            <h4>رایگان برای خرید بالای 300 هزار تومان</h4>
                        </div>
                        <div class=" d-flex flex-column align-items-center justify-content-center">
                            <img src="/frontend/img/icons8-secure-50.png" alt="" class="p-1 ">
                            <h3 class="my-1"> پرداخت مطمئن</h3>
                            <h4>پس از دریافت کالا</h4>
                        </div>
                    </div>
                </div>
                </div>
        </div>

        <nav class="desctab  p-0 mt-3">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">معرفی محصول</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">مشخصات محصول</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">نظرات کاربران</a>
                </div>
            </nav>
        <div class="description  tab-content mb-5 pt-4 px-3 bg-white" id="nav-tabContent">
                <div class="tab-pane fade show active text-right" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <p class="text-justify mx-3">{!! $product->short_desc !!}</p>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="d-flex">
                        <div class="col-4">
                            <ul class="text-right pr-0">
                                @foreach($product->attributeValues as $attribute)
                                    <li class="py-2"><a href="#" class="my-2 py-2 px-1">{{$attribute->attributeGroup->name}}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-8">
                            <ul class="text-right pr-0">
                                @foreach($product->attributeValues as $attribute)
                                    <li class="py-2"><a href="#" class="my-2 py-2 px-1">{{$attribute->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
{{--            comments    --}}
                <div class="tab-pane fade mb-5" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="comment d-flex flex-column align-items-start">
                        <form class=" col-md-7" method="post" action="{{route('frontend.comment.store',$product->id)}}">
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
                                <textarea type="text" rows="10" class="custom-field form-control form-control-sm ckeditor"  id="textareaDescription" name="description" placeholder="توضیحات را وارد کنید..."></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn">ارسال</button>
                            </div>
                        </form>

                        <div class="col-md-7">
                        @foreach($product->comments as $comment)

                            <div class=" mb-4 ml-4 text-right d-flex flex-column align-items-start col-md-12">
                                <div class="text-right d-flex w-100">
                                    <img class=" rounded-circle" src="http://placehold.it/50x50" alt="">
                                    <div class="d-flex justify-content-between mr-2 w-100 align-items-center">
                                        <h5 class="mt-0">{{$comment->name}}</h5>
                                        <button class="btn btn-outline-dark reply btn-open mb-2" id="div-comment-{{$comment->id}}">پاسخ</button>
                                    </div>
                                </div>
                                <p class="m-0 mb-2 mr-5">{{$comment->description}}</p>

                                    <div class="form-reply col-md-12" id="f-div-comment-{{$comment->id}}" style="display: none">
                                        <form class=" col-md-7" method="post" action="{{route('frontend.comment.reply')}}">
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
                                                <textarea type="text" rows="10" class="custom-field form-control form-control-sm ckeditor"  id="textareaDescription_{{$comment->id}}" name="description" placeholder="توضیحات را وارد کنید..."></textarea>
                                            </div>
                                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn">ارسال</button>
                                            </div>

                                        </form>
                                    </div>
                                @if(count($comment->childrenRecursive) > 0)
                                    @include('frontend.partials.comments', ['comments' => $comment->childrenRecursive,'product'=>$product])
                                @endif
                            </div>

                        @endforeach
                            </div>

                    </div>
                </div>

            </div>
        <div class="mytextdiv d-flex flex-row align-items-center justify-content-start mb-3 ">
                <div class="mytexttitle mt-3">
                    <h3 class="ml-2 mb-0 pr-2">محصولات مرتبط</h3>
                </div>
                <div class="divider mt-5"></div>
            </div>
        <div class="border d-flex flex-row flex-wrap py-3 align-items-center mb-2 bg-white owl-carousel owl-theme" id="owlProduct">
            @foreach($relatedProduct as $product)
                    <div class="col-12 col-md-3 ">
                        <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-2 ">
                            <a href="{{route('product.single',['slug'=>$product->slug])}}" class="text-center"><img src="{{$product->photos[0]->path}}" alt="" class="w-50"></a>
                            <h4 class="my-4">{{$product->name}}</h4>
                            @if($product->discount_price)
                                <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->price * 100))}}%</span></p>
                            @else
                                <h5>تومان {{$product->price}}</h5>
                            @endif
                            <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                                <a href="{{route('cart.add', ['id' => $product->id])}}"><img src="/frontend/img/icons8-shopping-cart-5022.png" alt="" class="mb-3"></a>
                                <img src="/frontend/img/icons8-heart-5022.png" alt="">
                                <img src="/frontend/img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('mainProject/js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
    <script src="{{asset('mainProject/js/swipebox/lib/ios-orientationchange-fix.js')}}"></script>
    <script src="{{asset('mainProject/js/swipebox/src/js/jquery.swipebox.min.js')}}"></script>
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('textareaDescription',{
            customConfig: 'config.js',
            toolbar:  [
                { name: 'styles', items: [ 'Styles' ] },
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', '-', 'RemoveFormat' ] },
                { name: 'clipboard', items: [ 'Undo', 'Redo' ] }
            ],
            language: 'fa',
            removePlugins: 'cloudservices, easyimage'
        })
        $('#addStar').change('.star', function(e) {
            $(this).submit();
        });

            // Elevate Zoom for Product Page image
        $("#zoom_01").elevateZoom({
            gallery:'gallery_01',
            cursor: 'pointer',
            zoomWindowPosition : 11,
            loadingIcon: 'image/progress.gif'
        });
        //////pass the images to swipebox
        $("#zoom_01").bind("click", function(e) {
            var ez =   $('#zoom_01').data('elevateZoom');
            $.swipebox(ez.getGalleryList());
            return false;
        });
            //comment form
            $(".btn-open").click(function(){
                $('.form-reply').css('display', 'none');
                var service = this.id;
                var service_id = '#f-' + service;
                $(service_id).show('slow');
            })
    </script>

@endsection
