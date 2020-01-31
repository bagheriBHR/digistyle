@extends('frontend.layout.master')
@section('style')
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
@endsection
@section('content')
    <div class="bg-grey d-flex px-3 pt-3 pb-3">
        <!-- right side -->
        <div class="col-2 d-flex flex-column p-0">
            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white">
                <h4 class="w-100 pb-2 text-right pr-3">جستجو در نتایج:</h4>
                <form class="form-inline d-flex pr-2 ">
                    <img src="/frontend/img/icons8-search-50.png" alt="">
                    <input class="form-control form-control-sm mr-sm-2 py-0 my-0" type="search" placeholder="نام محصول مورد نظر را وارد کنید ..." aria-label="Search">
                </form>
            </div>
            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">
                <h4 class="w-100 pb-2 text-right pr-3"> هنرمند :</h4>
                <form class="form-inline d-flex pr-2 ">
                    <img src="/frontend/img/icons8-search-50.png" alt="">
                    <input class="form-control form-control-sm mr-sm-2 py-0 my-0" type="search" placeholder="انتخاب هنرمند" aria-label="Search">
                </form>
            </div>
            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">
                <div class="d-flex flex-column align-items-center border-bottom pb-2">
                    <h4 class="w-100 pb-2 text-right pr-3">کاربرد:</h4>
                    <form class="form-inline d-flex pr-2 ">
                        <img src="/frontend/img/icons8-search-50.png" alt="">
                        <input class="form-control form-control-sm mr-sm-2 py-0 my-0" type="search" placeholder="جستجو کاربرد" aria-label="Search">
                    </form>
                </div>
                <div class="usage d-flex flex-column w-100 pr-2 mt-2">
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            جعبه جواهرات
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            گلدان
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            شطرنج
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            تخته نرد
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            ساعت
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            جعبه
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            سطل
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            شکلات خوری
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            قندان
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            شمعدان
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            تابلو
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            پادری
                        </label>
                    </div>
                </div>
            </div>
            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">
                <h4 class="w-100 pb-2 text-right pr-3">جنس:</h4>
                <div class=" d-flex flex-column w-100 pr-2 mb-2">
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            چوب
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            فلز
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            مس
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            برنج
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            طلا
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            خاک رس
                        </label>
                    </div>
                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">
                        <input class="form-check-input m-0" type="checkbox" value="" id="defaultCheck1 "  >
                        <label class="form-check-label mr-3" for="defaultCheck1">
                            استخوان
                        </label>
                    </div>
                </div>
            </div>
            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">
                <h4 class="w-100 pb-2 text-right pr-3">جستجو در رنگ:</h4>
                <div class="color d-flex justify-content-right">
                    <div class="bg-danger ml-2" ></div>
                    <div class="bg-success ml-2" ></div>
                    <div class="bg-dark ml-2" ></div>
                    <div class="bg-warning ml-2" ></div>
                    <div class="bg-info"></div>
                </div>
            </div>
            <div class="sidebar pt-2 d-flex flex-column align-items-start p-2 bg-white mt-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">فقط کالاهای موجود</label>
                </div>
            </div>
            <div class="sidebar pt-2 d-flex flex-column align-items-start p-2 bg-white mt-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">فقط کالاهای آماده ارسال</label>
                </div>
            </div>
            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">
                <h4 class="w-100 pb-2 text-right pr-3"> محدوده قیمت مورد نظر:</h4>
            </div>
        </div>
        <!-- end of right side -->
        <!-- left side -->
        <div class="col-10 d-flex flex-column pl-0">
            <div class="category_name text-right mb-2"><h3>{{$category->name}}</h3></div>
            <div class="sort d-flex justify-content-start align-items-center">
                <div class="btn-group">
                    <button type="button" onclick="gridView()" class="btn btn-default" title="Grid"><i class="fa fa-th"></i></button>
                    <button type="button" onclick="listView()" class="btn btn-default" title="List"><i class="fa fa-th-list"></i></button>
                </div>
                <h3 class="m-0 pr-2 ">مرتب سازی بر اساس:</h3>
                <ul class="d-flex m-0 p-2">
                    <li><a href="#" class="px-3">پرفروش ترین</a></li>
                    <li><a href="#" class="px-3">جدید ترین</a></li>
                    <li><a href="#" class="px-3">محبوب ترین</a></li>
                    <li><a href="#" class="px-3">ارزان ترین</a></li>
                    <li><a href="#" class="px-3">گران ترین</a></li>
                </ul>
            </div>
            <!-- products -->
            <div class=" d-flex flex-row flex-wrap ">
                @foreach($products as $product)
                    <div class="col-12 col-md-3 p-2 viewType">
                        <div class="product  d-flex flex-column  align-items-center justify-content-center position-relative bg-white border py-3 ">
                            <a href="{{route('product.single',['slug'=>$product->slug])}}" class="text-center"><img src="{{$product->photos[0]->path}}" alt="" class="w-50"></a>
                            <h4 class="my-4">{{$product->name}}</h4>
                            @if($product->discount_price)
                                <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->price * 100))}}%</span></p>
                            @else
                                <h5 >تومان {{$product->price}}</h5>
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
            <!-- end of products -->
        </div>
        <!-- end of left side -->
    </div>
@endsection
@section('script')
{{--    <script src="{{asset('js/app.js')}}"></script>--}}
    <script>
        // var elements = document.getElementsByClassName("viewType");
        //
        // // Declare a loop variable
        // var i;
        //
        // // List View
        // function listView() {
        //     for (i = 0; i < elements.length; i++) {
        //         elements[i].style.width = "100%";
        //     }
        // }
        //
        // // Grid View
        // function gridView() {
        //     for (i = 0; i < elements.length; i++) {
        //         elements[i].style.width = "50%";
        //     }
        // }

    </script>
@endsection

