<div class="sidebar pt-2 col-2 d-flex flex-column align-items-start p-1 bg-white">
    <h4 class="w-100 pb-3 text-right pr-3">دسته بندی کالاها</h4>
    <div class="d-flex flex-column align-item-start p-3">
        @foreach ($categories as $category)
            <h5 class="w-100 text-right pb-1"><a href="{{route('category.productShow',$category->slug)}}">{{$category->name}}</a></h5>
            <ul class="pr-3 pb-3">
                @if(count($category->childrenRecursive) > 0)
                    @foreach($category->childrenRecursive as $item)
                    <li><a href="{{route('category.productShow',$item->slug)}}">{{$item->name}}</a></li>
                        @endforeach
                    @endif
            </ul>
        @endforeach
    </div>
</div>
