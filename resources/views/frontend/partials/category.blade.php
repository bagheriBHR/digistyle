@foreach($categories as $category)
    @if(count($category->childrenRecursive) > 0)
        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle text-right" href="#">{{$category->name}} </a>
            <ul class="dropdown-menu">
                @include('frontend.partials.category',['categories'=>$category->childrenRecursive])
            </ul>
        </li>
        @else
            <li><a class="dropdown-item text-right" href="#">{{$category->name}} </a></li>
        @endif
@endforeach
