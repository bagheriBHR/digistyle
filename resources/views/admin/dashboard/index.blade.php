@extends('admin.layouts.master')
@section('style')
    <link href="{{asset('frontend/stuff.css')}}">
    @endsection
@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="d-flex flex-column w-100">
        <div class="row w-100 ">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$orderCount}}</h3>
                        <p>تعداد سفارشات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('order.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$productCount}}
    {{--                        <sup style="font-size: 20px">%</sup>--}}
                        </h3>

                        <p>تعداد محصولات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('product.index')}}" class="small-box-footer">اطلاعات بیشتر<i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$userCount}}</h3>

                        <p>تعداد کاربران</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('user.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$postCount}}</h3>

                        <p>تعداد مطالب</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-paper"></i>
                    </div>
                    <a href="{{route('post.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="d-flex">
            <div class="col-md-6 ">
                     <div class="box box-info ">
                        <div class="box-header ui-sortable-handle text-right">
                            <i class="fa fa-comments-o"></i>
                            <h3 class="box-title">نظرات</h3>
                        </div>
                        <div class="slimScrollDiv mt-3" style="position: relative; overflow:hidden; width: auto; height: 250px;">
                        <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
                            <!-- chat item -->
                            @foreach($comments as $comment)

                                <div class=" mb-4 ml-4 text-right d-flex flex-column align-items-start col-md-12">
                                    <div class="text-right d-flex w-100">
                                        <img class=" rounded-circle" src="http://placehold.it/30x30" alt="">
                                        <div class="d-flex justify-content-between mr-2 w-100 align-items-center">
                                            <h5 class="mt-0">{{$comment->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="mr-5">
                                          <p class="m-0 mb-2">{!! $comment->description !!}</p>
                                    </div>
                                </div>
                             @endforeach
                        </div>
                        <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 191.718px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">

                        </div>
                    </div>
                    <!-- /.chat -->
                     </div>
                </div>
            <div class="col-md-6 ">
                    <canvas id="myChart" height="170px" ></canvas>
                </div>
        </div>
        <div class="d-flex mt-3">
            <div class="col-md-6">
                <h6 class="text-center" style="color:#616161"> محصولات اخیر</h6>
                <table class="customtable w-100 table mb-0 pb-0">
                    <thead>
                    <tr>
                        <th class="text-center" >شناسه محصول</th>
                        <th class="text-center">نام </th>
                        <th class="text-center">قیمت</th>
                        <th class="text-center">قیمت ویژه</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=>$product)
                        <tr>
                            <td class="text-center p-0">{{ $product->sku }}</td>
                            <td class="text-center p-0">{{ $product->name }}</td>
                            <td class="text-center p-0">{{ $product->price }}</td>
                            <td class="text-center p-0">
                                @if($product->discount_price)
                                    {{ $product->discount_price }}
                            @else
                                <span>-</span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-center" style="color:#616161"> سفارشات اخیر</h6>
                <table class="customtable w-100 table mb-0 pb-0">
                    <thead>
                    <tr>
                        <th class="text-center" >شماره</th>
                        <th class="text-center" >مبلغ</th>
                        <th class="text-center" >وضعیت</th>
                        <th class="text-center" >زمان ایجاد</th>
                        <th class="text-center" ></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key=>$order)
                        <tr>
                            <td class="text-center" scope="row">{{convertToPersianNumber($key+1 ) }}</td>
                            <td class="text-center p-0">{{ $order->amount }}</td>
                            @if($order->status == 0)
                                <td class="text-center"><span class="bg-danger text-light p-1">پرداخت نشده</span></td>
                            @else
                                <td class="text-center"><span class="bg-success text-light p-1">پرداخت شده</span></td>
                            @endif
                            <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($order->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
                            <td class="text-center p-0"><a href="{{route('order.list',['id'=>$order->id])}}"><label class="btn btn-info text-white mb-0">مشاهده جزئیات</label></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/libs/jquery.min.js')}}"></script>
    <script src="{{asset('js/libs/Chart.min.js')}}"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد','شهریور'],
                datasets: [{
                    label: 'نمودار فروش',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    @endsection
