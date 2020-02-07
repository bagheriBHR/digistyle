<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with(['user','category','photo'])->paginate(20);
        return view('admin.post.index',compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where('parent_id',null)->get();
        return view('admin.post.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post();
        $post->photo_id = $request->photo_id;
        $post->title=$request->title;
        $post->description=$request->description;
        if($request->slug){
            $post->slug=make_slug($request->slug);
        }else{
            $post->slug=make_slug($request->title);
        }
        $post->meta_description=$request->meta_description;
        $post->meta_keywords=$request->meta_keywords;
        $post->status=$request->status;
        $post->category_id=$request->category;
        $post->user_id=Auth::id();
        $post->save();
        Session::flash('success', 'مطلب با موفقیت اضافه شد.');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories=Category::where('parent_id',null)->get();
        return view('admin.post.edit',compact(['post','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request,$id)
    {
        $post = Post::find($id);
        $post->photo_id = $request->photo_id;
        $post->title = $request->title;
        $post->description=$request->description;
        if($request->slug){
            $post->slug=make_slug($request->slug);
        }else{
            $post->slug=make_slug($request->title);
        }
        $post->meta_description=$request->meta_description;
        $post->meta_keywords=$request->meta_keywords;
        $post->status=$request->status;
        $post->category_id=$request->category;
        $post->user_id=Auth::id();
        $post->save();
        Session::flash('success', 'مطلب با موفقیت ویرایش شد.');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id)->delete();
        Session::flash('delete', 'مطلب با موفقیت حذف گردید.');
        return redirect()->route('post.index');
    }
}
