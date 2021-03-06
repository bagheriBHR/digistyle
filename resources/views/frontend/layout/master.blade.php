<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('fonts/font-face.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('frontend/owlCarousel/dist/assets/owl.theme.default.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('frontend/owlCarousel/dist/assets/owl.carousel.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('fonts-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <link rel="stylesheet" href="{{asset('mainProject/css/stylesheet.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/stuff.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/comparison.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/product.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/bootstrap/css/bootstrap.min.css')}}">
    <title>E-commerce</title>
    @yield('style')
</head>
<body>
<!-- navbar -->
<nav class="container-fluid navbar navbar-expand-lg navbar-light d-flex flex-column px-3 position-relative pb-0">
    <div class=" up d-flex flex-column flex-md-row justify-content-between align-items-center w-100">
        <a class="navbar-brand font-weight-bold" href="{{url('/')}}"><img src="/frontend/img/logo.png" alt=""> فروشگاه <span>صنایع دستی</span></a>
        <form class="form-inline w-50 " action="{{route('frontend.search.product')}}" method="get">
            <input class="form-control form-control-sm mr-sm-2 py-0 my-0 w-75 " name="title" type="search" placeholder="جستجو محصول" aria-label="Search">
            <button class="btn my-2 my-sm-0 py-0 my-0 mr-auto" type="submit"><img src="/frontend/img/icons8-search-50.png" alt=""></button>
        </form>
        <div class="d-flex" id="header">
{{--            <div class="dropdown">--}}
{{--                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    Dropdown--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">--}}
{{--                    <button class="dropdown-item" type="button">Action</button>--}}
{{--                    <button class="dropdown-item" type="button">Another action</button>--}}
{{--                    <button class="dropdown-item" type="button">Something else here</button>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="">
                @if(Auth::check())
                    <a href="{{route('user.profile')}}" class="mr-3 p-2 txt_green"> پروفایل کاربری</a>
                    <a href="{{route('logout')}}" class="mr-3 p-2 txt_green" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit()">خروج</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{route('register')}}" class="mr-3 p-2 txt_green"><img src="/frontend/img/icons8-user-50.png" alt=""> ثبت نام</a>
                    <a href="{{route('login')}}" class="mr-3 p-2 txt_green"><img src="/frontend/img/icons8-lock-50.png" alt=""> ورود </a>
                @endif
            </div>
            <!-- Mini Cart Start-->
            <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div id="cart" class="btn-group">
                    <button type="button" data-toggle="dropdown" data-loading-text="بارگذاری ..." class="heading dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <img width="20px" height="20px" src="{{asset('frontend/img/icons8-shopping-cart-50.png')}}" alt="">
                        <span id="cart-total" class="text-dark">{{Session::has('cart') ? Session::get('cart')->totalQty . ' آیتم' : ''}} {{Session::has('cart') ? Session::get('cart')->totalPrice . ' تومان' : ''}}</span>
                    </button>
                    <div class="dropdown-menu">
                    <ul >
                        @if(Session::has('cart'))
                            <li>
                                <table class="table">
                                    @foreach(Session::get('cart')->items as $product)
                                        <tbody>
                                        <tr>
                                            <td class="text-center" width="18%"><img class="img-thumbnail w-100"src="{{$product['item']->photos[0]->path}}"></td>
                                            <td class="text-left">{{$product['item']->title}}</td>
                                            <td class="text-right">x {{$product['qty']}}</td>
                                            <td class="text-right">{{$product['price']}} تومان</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-xs remove" title="حذف" onclick="event.preventDefault();
                                                    document.getElementById('remove-cart-item_{{$product['item']->id}}').submit();" type="button"><i class="fa fa-times"></i></button>
                                            </td>
                                            <form id="remove-cart-item_{{$product['item']->id}}" action="{{ route('cart.remove', ['id' => $product['item']->id]) }}" method="post" style="display: none;">
                                                @csrf
                                            </form>
                                        </tr>

                                        </tbody>
                                    @endforeach
                                </table>
                            </li>
                            <li>
                                <div>
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
                                        <tr>
                                            <td class="text-right"><strong>قابل پرداخت</strong></td>
                                            <td class="text-right">{{Session::get('cart')->totalPrice}} تومان</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p class=""><a href="{{route('cart.cart')}}" class="btn gold-btn" style="color: #fff"><i class="fa fa-shopping-cart" style="color: #fff""></i> مشاهده سبد</a>&nbsp;</p>

                                </div>
                            </li>

                        @else
                            <p>سبد خرید شما خالی است.</p>
                        @endif
                    </ul>
                    </div>
                </div>
            </div>
            <!-- Mini Cart End-->

        </div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex justify-content-between w-100 p-0">
            <li class="nav-item active py-3 px-3">
                <a class="nav-link" href="{{url('/')}}"><img src="/frontend/img/icons8-home-50.png" alt=""> صفحه اصلی <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item py-3 px-3">
                <a class="nav-link" href="#"><img src="/frontend/img/icons8-news-50.png" alt=""> مجله فروشگاهی</a>
            </li>
            <li class="nav-item py-3 px-3">
                <a class="nav-link" href="#"><img src="/frontend/img/icons8-new-50.png" alt=""> جدیدترین ها</a>
            </li>
            <li class="nav-item py-3 px-3 dropdown">
                <a class=" nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/frontend/img/icons8-product-50.png" alt="">محصولات
                </a>
                <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                    @foreach($categories as $category)
                        @if(count($category->childrenRecursive) > 0)
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle text-right"  href="{{route('category.productShow',$category->slug)}}">{{$category->name}} </a>
                                <ul class="dropdown-menu">
                                    @include('frontend.partials.category',['categories'=>$category->childrenRecursive])
                                </ul>
                            </li>
                        @else
                            <li><a class="dropdown-item text-right" href="{{route('category.productShow',$category->slug)}}">{{$category->name}} </a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li class="nav-item py-3 px-3">
                <a class="nav-link" href="#"><img src="/frontend/img/icons8-help-50.png" alt=""> راهنمای خرید فروشگاه</a>
            </li>
            <li class="nav-item py-3 px-3">
                <a class="nav-link" href="#"><img src="/frontend/img/icons8-policy-document-50.png" alt=""> قوانین فروشگاه</a>
            </li>
            <li class="nav-item py-3 px-3">
                <a class="nav-link" href="#"><img src="/frontend/img/icons8-info-50.png" alt=""> درباره ما</a>
            </li>
            <li class="nav-item py-3 px-3">
                <a class="nav-link" href="#"><img src="/frontend/img/icons8-phone-contact-50.png" alt=""> تماس با ما</a>
            </li>
        </ul>
    </div>
    <!-- <img src="img/background.png" class="position-absolute" alt=""> -->
</nav>
<!-- end of navbar -->
<div class="bg-light">
    @yield('content')
</div>
<!-- footer -->
<div class="container-fluid bgfooter pt-5 px-0 shadow-lg">
    <div class="d-flex flex-column">
        <div class="footer px-5 d-flex flex-column flex-md-row">
            <div class="col-12 col-md-6 d-flex flex-column ">
                <div class="d-flex flex-column flex-md-row align-items-start">
                    <div class="col-12 col-md-6  mt-md-0 ">
                        <div class="d-flex flex-column align-items-start">
                            <!-- Footer main menu -->
                            <h3 class="pb-3 mb-2 w-100 text-right"><img src="/frontend/img/icons8-chevron-down-50.png" alt="" class="ml-2">خدمات مشتریان</h3>
                            <ul class="footernav navbar-nav d-flex flex-column p-0 text-right">
                                <li class="nav-item">
                                    <a class="nav-link px-2 pb-1 pt-0" href="#"><img src="/frontend/img/icons8-filled-circle-50.png" alt="" class="ml-3"> حریم خصوصی</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 py-1" href="#"><img src="/frontend/img/icons8-filled-circle-50.png" alt="" class="ml-3">شرایط و قوانین</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 py-1" href="#"><img src="/frontend/img/icons8-filled-circle-50.png" alt="" class="ml-3">رویه پازگشت کالا</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 py-1" href="#"><img src="/frontend/img/icons8-filled-circle-50.png" alt="" class="ml-3">پاسخ به پرسش های متداول</a>
                                </li>
                            </ul>
                            <!-- End of Footer main menu -->
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-md-0 ">
                        <div class="d-flex flex-column align-items-start">
                            <h3 class="pb-3 mb-2  w-100 text-right"><img src="/frontend/img/icons8-chevron-down-50.png" alt="" class="ml-2"> راهنمای خرید</h3>
                            <!-- Footer products -->
                            <ul class="footernav navbar-nav d-flex flex-column p-0 text-right w-100">
                                <li class="nav-item">
                                    <a class="nav-link px-2 pb-1 pt-0" href="#"><img src="/frontend/img/icons8-filled-circle-50.png" alt="" class="ml-3">مراحل ثبت سفارش</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 py-1" href="#"><img src="/frontend/img/icons8-filled-circle-50.png" alt="" class="ml-3"> رویه ارسال سفارش</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2 py-1" href="#"><img src="/frontend/img/icons8-filled-circle-50.png" alt="" class="ml-3">شیوه های پرداخت</a>
                                </li>
                            </ul>
                            <!-- End of Footer products -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column">
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <div class="col-12 col-md-5 d-flex flex-column mt-md-0">
                            <h3 class=" pb-3 mb-2 w-100 text-right"><img src="/frontend/img/icons8-chevron-down-50.png" alt="" class="ml-2">راه های ارتباط با ما</h3>
                            <div class="d-flex flex-column align-items-start">
                                <div class="contact d-flex">
                                    <h4 class=" ml-2"><img src="/frontend/img/icons8-phone-50.png" alt="" class="ml-2"> تلفن:</h4>
                                    <h5>(555) 555-55555</h5>
                                </div>
                                <div class="contact d-flex">
                                    <h4 class=" ml-2"><img src="/frontend/img/icons8-email-open-50.png" alt="" class="ml-2"> ایمیل:</h4>
                                    <h5>email@yahoo.com</h5>
                                </div>
                                <div class="contact d-flex">
                                    <h4 class=" ml-2"><img src="/frontend/img/icons8-address-50.png" alt="" class="ml-2"> آدرس:</h4>
                                    <h5 class="text-justify">...</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-7  mt-md-0 ">
                            <h3 class=" pb-3 mb-2 w-100 text-right"><img src="/frontend/img/icons8-chevron-down-50.png" alt="" class="ml-2">عضویت در خبرنامه</h3>
                            <div class="input-group px-2 mb-4 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">ارسال</span>
                                </div>
                                <input type="text" class="form-control text-right pr-0 py-0" id="basic-url" aria-describedby="basic-addon3" placeholder="لطفا ایمیل خود را وارد کنید"/>
                            </div>
                            <div class="trust d-flex justify-content-start w-75">
                                <img src="/frontend/img/trusticon.png" alt="" class="mx-2 p-2">
                                <img src="/frontend/img/trusticon2.png" alt="" class="mx-2 p-2">
                                <img src="/frontend/img/trusticon3.png" alt="" class="mx-2 p-2">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of contact us -->
            </div>
            <!-- end of about us -->
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center border-top mt-4 mx-5">
        <div class="d-flex flex-column flex-md-row justify-content-around w-75 mt-4">
            <div class=" service d-flex flex-column align-items-center justify-content-center">
                <img src="/frontend/img/icons8-return-purchase-50.png" alt="" class=" p-1">
                <h3 class="my-2 mx-4">ضمانت بازگشت کالا</h3>
                <h4>به مدت 10 روز</h4>
            </div>
            <div class=" service d-flex flex-column align-items-center justify-content-center">
                <img src="/frontend/img/icons8-quality-50.png" alt="" class="p-1">
                <h3 class="my-2 mx-4">ضمانت اصالت و کیفیت</h3>
                <h4>دست سازه های ایرانی</h4>
            </div>
            <div class=" service d-flex flex-column align-items-center justify-content-center">
                <img src="/frontend/img/icons8-delivery-50.png" alt="" class="p-1 ">
                <h3 class="my-2 mx-4">ارسال سریع</h3>
                <h4>رایگان برای خرید بالای 300 هزار تومان</h4>
            </div>
            <div class=" service d-flex flex-column align-items-center justify-content-center">
                <img src="/frontend/img/icons8-secure-50.png" alt="" class="p-1" >
                <h3 class="my-2 mx-4"> پرداخت مطمئن</h3>
                <h4>پس از دریافت کالا</h4>
            </div>
        </div>
    </div>
    <div class="bg-end d-flex align-items-center justify-content-between  mt-3 py-2 mx-5">
        <h6 class="text-white m-0 font-weight-normal">کلیه حقوق این سایت محفوظ می باشد.</h6>
        <div class="d-flex justify-content-start pt-2 pt-md-2">
            <div class="follow d-flex align-items-center justify-content-center ">
                <img src="/frontend/img/telegram.png" alt=""/>
            </div>
            <div class="follow d-flex align-items-center justify-content-center  mx-2">
                <img src="/frontend/img/instagram.png" alt=""/>
            </div>
            <div class="follow d-flex align-items-center justify-content-center">
                <img src="/frontend/img/whatsapp.png" alt=""/>
            </div>
        </div>
    </div>
</div>

<!-- end of footer -->
{{--app.js should be in the first line--}}



{{--<script src="{{asset('frontend/bootstrap/js/jquery.min.js')}}"></script>--}}
<script src="{{asset('frontend/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('frontend/bootstrap/js/bootstrap.min.js')}}"></script>
{{--<script src="{{asset('js/app.js')}}"></script>--}}
@yield('scripts')
{{--<script src="{{asset('frontend/owlCarousel/dist/owl.carousel.js')}}"></script>--}}

<script>
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });


        return false;
    });
</script>

</body>
</html>
