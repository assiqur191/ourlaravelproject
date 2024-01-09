<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;



class PostController extends Controller
{
    //
    public function showCreateForm(){
        return view("create-post");


    }
    public function storeNewPost(Request $request){
      $incomingPost= $request->validate([
        'title'=>['required','string','max:60'],
        'body'=> ['required']
      ]);
       $incomingPost['title']= strip_tags($incomingPost['title']);
       $incomingPost['body']=strip_tags($incomingPost['body']);
       $incomingPost['user_id']= auth()->id();
       $newPost = Post::create($incomingPost);
      return redirect("/post/{$newPost->id}")->with("success","your post created") ;

    }
    public function viewSinglePost(Post $post){
       
        return view('single-post',['post'=>$post]);
    }
    
     public function viewpost(){
      $posts = Post::all();
      // echo "<pre>"; print_r($posts); die;
      // dd( $posts);
        return view('viewpost',compact('posts'));
     }
}
