@extends('frontend.layout.master')
@section('style')
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
@endsection
@section('content')
    <div class="bg-grey d-flex px-3 pt-3 pb-3">
        <!-- right side -->
    @include('frontend.partials.sidebar',['categories'=>$categories])
    <!-- end of right side -->
        <!-- left side -->
        <div class="col-10 d-flex flex-column pl-0">
            <div class="sort d-flex justify-content-start align-items-center">
                @if($products->count()>0)
                <div class="category_name text-right mr-3"><h6>نتایج جستجو برای:  {{$query}}</h6></div>
                    @else
                    <div class="category_name text-right mr-3"><h6>موردی یافت نشد</h6></div>
                @endif
            </div>
            <div class=" d-flex flex-row flex-wrap">
                @foreach($products as $product)
                <div class="product my-3 bg-white border col-12 col-md-3 p-2 viewType">
                    <div class="  d-flex flex-column align-items-center justify-content-center position-relative py-3 ">
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
        </div>
        <!-- end of left side -->
    </div>
@endsection
@section('scripts')
@endsection

