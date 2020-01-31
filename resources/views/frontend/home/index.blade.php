@extends('frontend.layout.master')
@section('scripts')
    <script>
        $(document).ready(function() {

            $('#owlProduct').owlCarousel({

                // Most important owl features
                items : 5,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [980,3],
                itemsTablet: [768,2],
                itemsTabletSmall: false,
                itemsMobile : [479,1],
                singleItem : false,

                //Basic Speeds
                slideSpeed : 200,
                paginationSpeed : 800,
                rewindSpeed : 1000,

                //Autoplay
                autoPlay : false,
                stopOnHover : false,

                // Navigation
                navigation : false,
                navigationText : ["prev","next"],
                rewindNav : true,
                scrollPerPage : false,

                //Pagination
                pagination : true,
                paginationNumbers: false,

                // Responsive
                responsive: true,
                responsiveRefreshRate : 200,
                responsiveBaseWidth: window,

                // CSS Styles
                baseClass : "owl-carousel",
                theme : "owl-theme",

                //Lazy load
                lazyLoad : false,
                lazyFollow : true,

                //Auto height
                autoHeight : false,

                //JSON
                jsonPath : false,
                jsonSuccess : false,

                //Mouse Events
                mouseDrag : true,
                touchDrag : true,

                //Transitions
                transitionStyle : false,

                // Other
                addClassActive : false,

                //Callbacks
                beforeInit: false,
                afterInit: false,
                beforeMove: false,
                afterMove: false,
                afterAction: false,
                startDragging : false

            })

        });
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
@endsection


@section('content')
    <!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide px-3 mt-2" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="frontend/img/carousel.jpg" class="d-block w-100" alt="...">
            </div>
            <!-- <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
            </div> -->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- end of carousel -->
    <div class="bg-grey d-flex px-3 pt-3 pb-3">
        <!-- right side -->
        @include('frontend.partials.sidebar')
        <!-- end of right side -->
        <!-- left side -->
        <div class="col-10 d-flex flex-column pl-0">
            <!-- category -->
            <div class="d-flex flex-wrap mb-3">
                @foreach($categories as $category)
                <div class=" col-3 pl-0 mb-3">
                    <div class="category bg-white d-flex flex-column align-items-center justify-content-center p-2 ">
                        <img src="{{$category->photo->path}}" alt="" class="w-100">
                        <a href="#" class="font-weight-bold mt-2 py-1 left">{{$category->name}}<img src="frontend/img/icons8-chevron-down-50.png" alt=""></a>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end of category -->
            <!-- offers -->
            <div class="mytextdiv d-flex flex-row align-items-center justify-content-start mb-3">
                <div class="mytexttitle mt-3">
                    <h3 class="ml-2 mb-0 pr-2">منتخب جدیدترین کالاها</h3>
                </div>
                <div class="divider mt-5"></div>
            </div>
            <div class="border d-flex flex-row flex-wrap py-5 mb-2 bg-white owl-carousel owl-theme" id="owlProduct">
                @foreach($latestProduct as $product)
                     <div class="col-12 col-md-2 ">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <a href="{{route('product.single',['slug'=>$product->slug])}}" class="text-center"><img src="{{$product->photos[0]->path}}" alt="" class="w-50"></a>
                        <h4 class="my-4">{{$product->name}}</h4>
                        @if($product->discount_price)
                            <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->price * 100))}}%</span></p>
                        @else
                            <p class="price"><span class="price-new">{{$product->price}} تومان</span></p>
                        @endif
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <a href="{{route('cart.add', ['id' => $product->id])}}"><img src="frontend/img/icons8-shopping-cart-5022.png" alt="" class="mb-3"></a>
                            <img src="frontend/img/icons8-heart-5022.png" alt="">
                            <img src="frontend/img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mytextdiv d-flex flex-row align-items-center justify-content-start mb-3">
                <div class="mytexttitle mt-3">
                    <h3 class="ml-2 mb-0 pr-2">محبوبترین کالاها </h3>
                </div>
                <div class="divider mt-5"></div>
            </div>
            <div class="border d-flex flex-row flex-wrap py-5 mb-2 bg-white">
                <div class="col-12 col-md-2 ">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/گلدان خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">گلدان خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/goldan.png" alt="" class="w-50">
                        <h4 class="my-4">گلدان فیروزه کوب</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 ">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/shokolatkhori.png" alt="" class="w-50">
                        <h4 class="my-4">شکلات خوری فیروزه کوب</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/ساعت خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">ساعت خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3">
                        <img src="img/جعبه خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">جعبه خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3">
                        <img src="img/تخته خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">تخته خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mytextdiv d-flex flex-row align-items-center justify-content-start mb-3">
                <div class="mytexttitle mt-3">
                    <h3 class="ml-2 mb-0 pr-2">پرفروش ترین ها </h3>
                </div>
                <div class="divider mt-5"></div>
            </div>
            <div class="border d-flex flex-row flex-wrap py-5 bg-white">
                <div class="col-12 col-md-2 ">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/گلدان خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">گلدان خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/goldan.png" alt="" class="w-50">
                        <h4 class="my-4">گلدان فیروزه کوب</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 ">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/shokolatkhori.png" alt="" class="w-50">
                        <h4 class="my-4">شکلات خوری فیروزه کوب</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
                        <img src="img/ساعت خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">ساعت خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product  d-flex flex-column align-items-center justify-content-center position-relative py-3">
                        <img src="img/جعبه خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">جعبه خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="product d-flex flex-column align-items-center justify-content-center position-relative py-3">
                        <img src="img/تخته خاتم.png" alt="" class="w-50">
                        <h4 class="my-4">تخته خاتم</h4>
                        <h5>10000 تومان</h5>
                        <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                            <img src="img/icons8-shopping-cart-5022.png" alt="" class="mb-3">
                            <img src="img/icons8-heart-5022.png" alt="">
                            <img src="img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of offers -->
            <!-- articles -->
            <div class="d-flex flex-column">
                <div class="mytextdiv d-flex flex-row align-items-center justify-content-start mb-3 mt-2">
                    <div class="mytexttitle mt-3">
                        <h3 class="ml-2 mb-0 pr-2">مقالات صنایع دستی</h3>
                    </div>
                    <div class="divider mt-5"></div>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="col-12 col-md-3 pl-0">
                        <div class="article d-flex flex-column justify-content-center align-items-center border p-2">
                            <img src="img/article1.jpg" alt="" class="w-100">
                            <h4 class="mt-2">عنوان مقاله</h4>
                            <p class="text-justify my-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            <button class="btn my-2">ادامه مطلب</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 pl-0">
                        <div class="article d-flex flex-column justify-content-center align-items-center border p-2">
                            <img src="img/article2.jpg" alt="" class="w-100">
                            <h4 class="mt-2">عنوان مقاله</h4>
                            <p class="text-justify my-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            <button class="btn my-2">ادامه مطلب</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 pl-0">
                        <div class="article d-flex flex-column justify-content-center align-items-center border p-2">
                            <img src="img/article3.jpg" alt="" class="w-100">
                            <h4 class="mt-2">عنوان مقاله</h4>
                            <p class="text-justify my-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            <button class="btn my-2">ادامه مطلب</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 pl-0">
                        <div class="article d-flex flex-column justify-content-center align-items-center border p-2">
                            <img src="img/article4.jpg" alt="" class="w-100">
                            <h4 class="mt-2">عنوان مقاله</h4>
                            <p class="text-justify my-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            <button class="btn my-2">ادامه مطلب</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of articles -->

        </div>
        <!-- end of left side -->
    </div>
    <div class="about d-flex flex-column align-items-center px-3 py-5">
        <h4 class="mb-3">فروشگاه اینترنتی صنایع دستی</h4>
        <p class="text-justify">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
    </div>
@endsection


