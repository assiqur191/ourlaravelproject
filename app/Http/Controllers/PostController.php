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
       Post::create($incomingPost);
       return redirect('/')->with('success','POST create');

    }
}
