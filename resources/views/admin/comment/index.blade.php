@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0">
        <div class="bg d-flex justify-content-between align-items-center">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">لیست نظرات </h3>
        </div>
        @if(Session::has('delete'))
            <div class="alert alert-danger text-right">
                <div>{{Session('delete')}}</div>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success text-right">
                <div>{{Session('success')}}</div>
            </div>
        @endif
        <table class="customtable w-100 table mb-0 pb-0">
            <thead>
            <tr>
                <th class="text-center" >شماره</th>
                <th class="text-center" >نام و نام خانوادگی</th>
                <th class="text-center">پست الکترونیکی</th>
                <th class="text-center">نظر</th>
                <th class="text-center">محصول مرتبط</th>
                <th class="text-center">وضعیت</th>
                <th class="text-center" >زمان ایجاد</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $key=>$comment)
                <tr>
                    <td class="text-center" scope="row">{{convertToPersianNumber($key+1 ) }}</td>
                    <td class="text-center p-0">{{ $comment->name }}</td>
                    <td class="text-center p-0">{{ $comment->email }}</td>
                    <td class="text-center p-0">{!! \Illuminate\Support\Str::limit( $comment->description,20) !!} </td>
                    <td class="text-center p-0">{{ $comment->product->name }}</td>
                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
                    <td class=" border-0 p-0">
                        <a href="{{route('comment.edit',$comment->id)}}" class="btn editbtn"><img src="{{asset('img/edit.png')}}" alt="" class="ml-2 moveFade">ویرایش کردن</a>
                    </td>
                    <td class="border-0 p-0">
                        <form action="{{route('comment.destroy',$comment->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn dropbtn"><img src="{{asset('img/delete.png')}}" alt="" class="ml-2 moveFade">حذف کردن</button>
                        </form>
                    </td>
                    @if($comment->status==0)
                        <td class=" border-0 p-0">
                            <form action="{{route('comment.action',$comment->id)}}" method="post">
                                @method('GET')
                                @csrf
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn btn-success text-light m-1">انتشار</button>
                            </form>
                        </td>
                    @else
                        <td class=" border-0 p-0">
                            <form action="{{route('comment.action',$comment->id)}}" method="post">
                                @method('GET')
                                @csrf
                                <input type="hidden" name="action" value="ignore">
                                <button type="submit" class="btn btn-danger text-light m-1">عدم انتشار</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
{{--        <div class="col-md-12 mt-3 d-flex justify-content-center">{{$comments->links()}}</div>--}}
    </div>
@endsection

