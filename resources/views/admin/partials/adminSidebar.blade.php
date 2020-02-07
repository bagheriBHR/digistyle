<div class="col-12 col-md-2 pr-0">
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-users ml-2"></i> کاربران
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('user.index')}}"><i class="fa fa-list-ul  ml-2"></i>لیست کاربران</a></td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('user.create')}}"><i class="fa fa-user-plus ml-2"></i>ثبت کاربران</a></td>
                </tr>
            </table>
        </div>
    </div>

    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-shopping-cart ml-2"></i> محصولات
        </a>
    </p>
    <div class="collapse" id="collapseExample1">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('product.index')}}"><i class="fa fa-list-alt ml-2"></i>لیست محصولات</a></td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('product.create')}}"><i class="fa fa-plus ml-2"></i>ایجاد محصول</a></td>
                </tr>
            </table>
        </div>
    </div>

    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-list ml-2"></i>دسته بندی
        </a>
    </p>
    <div class="collapse" id="collapseExample2">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('category.index')}}"><i class="fa fa-list ml-2"></i>لیست دسته بندی ها</a></td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('category.create')}}"><i class="fa fa-plus ml-2"></i>ثبت دسته بندی</a></td>
                </tr>
            </table>
        </div>
    </div>
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-circle-o ml-2"></i> ویژگی ها
        </a>
    </p>
    <div class="collapse" id="collapseExample3">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('attributeGroup.index')}}"><i class="fa fa-list ml-2"></i>لیست عنوان ویژگی ها </a></td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('attributeValue.index')}}"><i class="fa fa-list ml-2"></i>لیست مقادیر ویژگی ها </a></td>
                </tr>
            </table>
        </div>
    </div>
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-apple ml-2"></i> برند ها
        </a>
    </p>
    <div class="collapse" id="collapseExample4">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('brand.index')}}"><i class="fa fa-list ml-2"></i>لیست برندها </a></td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('brand.create')}}"><i class="fa fa-plus ml-2"></i>اضافه کردن برند</a></td>
                </tr>
            </table>
        </div>
    </div>
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-ticket ml-2"></i>کوپن
        </a>
    </p>
    <div class="collapse" id="collapseExample5">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('coupon.index')}}"><i class="fa fa-list ml-2"></i>لیست کوپن ها </a></td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('coupon.create')}}"><i class="fa fa-plus ml-2"></i>اضافه کردن کوپن</a></td>
                </tr>
            </table>
        </div>
    </div>
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample6" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-first-order ml-2"></i>سفارشات
        </a>
    </p>
    <div class="collapse" id="collapseExample6">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('order.index')}}"><i class="fa fa-list ml-2"></i>لیست سفارشات  </a></td>
                </tr>
            </table>
        </div>
    </div>
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample7" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-comment ml-2"></i>نظرات
        </a>
    </p>
    <div class="collapse" id="collapseExample7">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('comment.index')}}"><i class="fa fa-list ml-2"></i>لیست نظرات  </a></td>
                </tr>
            </table>
        </div>
    </div>
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample8" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-newspaper-o ml-2"></i>مطالب
        </a>
    </p>
    <div class="collapse" id="collapseExample8">
        <div class="card card-body border-0 p-0 mb-5">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('post.index')}}"><i class="fa fa-list ml-2"></i> لیست مطالب</a></td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="{{route('post.create')}}"><i class="fa fa-plus ml-2"></i>ایجاد مطلب </a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
