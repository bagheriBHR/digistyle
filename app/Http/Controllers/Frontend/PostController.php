<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function postLike($id)
    {
        $post = Post::find($id);
//        return $post;
        $post->likes()->attach([Auth::user()->id]);
        $post->save();
        $userId = Auth::user()->id;
        $PostLike = Post::with(['likes'=>function($q) use($userId){
            $q->where('user_id',$userId);
        }])->whereId($id)->first();
        return response()->json(['post'=>$PostLike]);
    }
    public function postDislike($id)
    {
        $post = Post::find($id);
//        return $post;
        $post->likes()->detach([Auth::user()->id]);
        $post->save();
        $userId = Auth::user()->id;
        $PostLike = Post::with(['likes'=>function($q) use($userId){
            $q->where('user_id',$userId);
        }])->whereId($id)->first();
        return response()->json(['post'=>$PostLike]);
    }

    public function apiLikeCheck($id)
    {
        $userId = Auth::user()->id;
        $post = Post::with(['likes'=>function($q) use($userId){
            $q->where('user_id',$userId);
        }])->whereId($id)->first();
        return response()->json(['post'=>$post],200);

    }

    public function apiLikeCount($id)
    {
        $post = Post::whereId($id)->first();
        $count = $post->likes()->count();
        return response()->json(['count'=>$count],200);
    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('frontend.post.show',compact(['post']));
    }
}
