@foreach($categories as $key=>$category)
    <tr>
{{--        <td class="text-right " scope="row">{{convertToPersianNumber($key+1 ) }}</td>--}}
        <td class="text-right pr-5">{{str_repeat('------',$level)}}{{ $category->name }}</td>
        <td class="text-right p-0">{{\Hekmatinasser\Verta\Verta::instance($category->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran')) }}</td>
        <td class=" border-0 p-0">
            <a href="{{route('category.edit',$category->id)}}" class="btn editbtn"><img src="{{asset('img/edit.png')}}" alt="" class="ml-2 moveFade">ویرایش کردن</a>
        </td>
        <td class="border-0 p-0">
            <form action="{{route('category.destroy',$category->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn dropbtn"><img src="{{asset('img/delete.png')}}" alt="" class="ml-2 moveFade">حذف کردن</button>
            </form>
        </td>
        <td class=" border-0 p-0">
            <a href="{{route('category.createSetting',$category->id)}}" class="btn editbtn"><img src="{{asset('img/add.png')}}" alt="" class="ml-2 moveFade">افزودن ویژگی </a>
        </td>
    </tr>
    @if(count($category->childrenRecursive)>0)
        @include('admin.partials.category',['categories'=>$category->childrenRecursive , 'level'=>$level+1]);
    @endif
@endforeach
