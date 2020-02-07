@extends('admin.layouts.master')

@section('sidebar')
    @include('admin.partials.adminSidebar')
@endsection
@section('content')
    <div class="col-md-10 pb-3 px-0"  id="app">
        <div class="bg d-flex justify-content-between align-items-center">
            <h3 class="form-title text-right py-2 pr-2 mb-0 font-weight-normal">اطلاعات پست ها  </h3>
            <a href="{{route('post.create')}}" class="pl-3 add"><i class="fa fa-plus ml-2"></i>اضافه کردن</a>
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
                    <th class="text-center">شماره</th>
                    <th class="text-center">تصویر مطلب</th>
                    <th class="text-center">عنوان </th>
                    <th class="text-center">کاربر</th>
                    <th class="text-center">توضیحات</th>
                    <th class="text-center">دسته بندی</th>
                    <th class="text-center">وضعیت</th>
                    <th class="text-center">زمان ایجاد</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $key=>$post)
                <tr>
                    <td class="text-center p-0" scope="row">{{convertToPersianNumber($key+1 ) }}</td>
                    <td class="text-center p-0"><img src="{{ $post->photo ? $post->photo->path : "http://www.placehold.it/400" }}" alt="" class="my-1" style="width:40px;"></td>
                    <td class="text-center p-0">{{ $post->title }}</td>
                    <td class="text-center p-0">{{ $post->user->name }}</td>
                    <td class="text-center p-0">{{\Illuminate\Support\Str::limit($post->description,50) }}</td>
                    <td class="text-center p-0">{{ $post->category->name }}</td>
                    @if($post->status==0)
                         <td class="text-center p-0"><span class="badge badge-danger p-1">غیر فعال</span></td>
                    @elseif($post->status==1)
                        <td class="text-center p-0"> <span class="badge badge-success p-1"> فعال</span></td>
                    @endif
                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($post->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
                    <td class=" border-0 p-0">
                        <a href="{{route('post.edit',$post->id)}}" class="btn editbtn"><img src="{{asset('img/edit.png')}}" alt="" class="ml-2 moveFade">ویرایش کردن</a>
                    </td>
                    <td class="border-0 p-0">
                        <form action="{{route('post.destroy',$post->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn dropbtn"><img src="{{asset('img/delete.png')}}" alt="" class="ml-2 moveFade">حذف کردن</button>
                        </form>
                    </td>
                  </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-12 mt-3 d-flex justify-content-center">{{$posts->links()}}</div>
    </div>
@endsection
