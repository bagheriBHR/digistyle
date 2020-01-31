<script type="text/javascript">
    $(".btn-open").click(function(){
        $('.form-reply').css('display', 'none');
        var service = this.id;
        var service_id = '#f-' + service;
        $(service_id).show('slow');
    })
</script>
<div class="col-md-12 pl-0">
    @foreach($comments as $comment)

        <div class=" mb-4 text-right d-flex flex-column align-items-start">
            <div class="text-right d-flex w-100">
                <img class=" rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="d-flex justify-content-between mr-2 w-100 align-items-center">
                    <h5 class="mt-0">{{$comment->name}}</h5>
                    <button class="btn btn-outline-dark reply btn-open mb-2" id="div-comment-{{$comment->id}}">پاسخ</button>
                </div>
            </div>
            <p class="m-0 mb-2 mr-5">{{$comment->description}}</p>

            <div class="form-reply col-md-12" id="f-div-comment-{{$comment->id}}" style="display: none">
                <form class=" col-md-12" method="post" action="{{route('frontend.comment.reply',$product->id)}}">
                    @method('POST')
                    @csrf
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control form-control-sm" name="name" placeholder="نام و نام خانوادگی خود را وارد کنید."/>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control form-control-sm" name="email" id="inputAddress" placeholder="پست الکترونیکی خود را وارد کنید."/>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm ckeditor"  id="textareaDescription_{{$comment->id}}" name="description" placeholder="توضیحات را وارد کنید..."></textarea>
                    </div>
                    <input type="hidden" name="parent_id" value="{{$comment->id}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn">ارسال</button>
                    </div>
                </form>
            </div>
            @if(count($comment->childrenRecursive) > 0)
                @include('frontend.partials.comments', ['comments' => $comment->childrenRecursive,'product'=>$product])
            @endif
        </div>

    @endforeach
</div>
