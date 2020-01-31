<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with(['product'])->get();
        return view('admin.comment.index',compact(['comments']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin.comment.edit',compact(['comment']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->description = $request->description;
        $comment->save();
        Session::flash('success', 'نظر شما با موفقیت ویرایش شد.');
        return redirect()->route('comment.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id)->delete();

        Session::flash('delete', 'نظر شما با موفقیت حذف شد.');
        return redirect()->route('comment.index');
    }
    public function action(Request $request,$id)
    {
        $comment=Comment::find($id);
        if($request->input('action')=='approve'){
            $comment->status=1;
            $comment->save();
            Session::flash('success','نظر تایید شد');
        }
        else{
            $comment->status=0;
            $comment->save();
            Session::flash('delete','نظر تایید نشد');
        }
        return back();

    }
}
