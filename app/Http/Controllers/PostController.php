<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Origin;


use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image As image;
use Intervention\Image\Interfaces\EncodedImageInterface;
use Intervention\Image\Drivers\Gd\Modifiers\ResizeModifier;

class PostController extends Controller
{
  public function search($term){
    $posts = Post::search($term)->get();
    $posts->load('user:username,id,avatar');
    return $posts;
  }
  public function showEditPost(Post $post)
  {
    return view('edit-post', ['post' => $post]);
  }
  //post edit and update in this function
  public function updatePost(Post $post, Request $request)
  {
    $incomingPost = $request->validate([
      'title' => ['required', 'string', 'max:60'],
      'body' => ['required']
    ]);
    $incomingPost['title'] = strip_tags($incomingPost['title']);
    $incomingPost['body'] = strip_tags($incomingPost['body']);

    $post->update($incomingPost);
    return back()->with('success', 'your post update successfully');

  }

  public function delete(Post $post)
  {
    //making delete button alive
    //  if(auth()->user()->cannot('delete',$post)){
    //   return 'You cannot do that';
    //  }
    $post->delete();
    return redirect('/profile/' . auth()->user()->username)->with('success', 'you are succesfuly delete the post');


  }
  //
  public function showCreateForm()
  {
    return view("create-post");

  }
  public function storeNewPost(Request $request)
  {
    $incomingPost = $request->validate([
      'title' => ['required', 'string', 'max:60'],
      'body' => ['required']
    ]);
    $incomingPost['title'] = strip_tags($incomingPost['title']);
    $incomingPost['body'] = strip_tags($incomingPost['body']);
    $incomingPost['user_id'] = auth()->id();
    $newPost = Post::create($incomingPost);
    return redirect("/post/{$newPost->id}")->with("success", "your post created");

  }
  public function viewSinglePost(Post $post)
  {

    return view('single-post', ['post' => $post]);
  }

  public function viewPostById($user_id)
  {
    // print_r( $user_id );
    // $user= Post::findOrFail($user_id);
    # This is similar to SQL " SELECT * from post where user.id = {user_id}". This is not valid SQL. 
    $userPosts = Post::where('user_id', $user_id)->get();

    // $postTitles = $user->posts()->plunk('title');
    // return view ('viewpost', ['postTitle' =>$postTitles , 'user'=>$user]);
    return view('viewpost', ['userPosts' => $userPosts]);


    // $posts = Post::all();
    // // echo "<pre>"; print_r($posts); die;
    // // dd( $posts);

    //   return view('viewpost',compact('posts'));
  }
  public function avatarUploadPage()
  {
    if (auth()->check()) {
      return view("avatarupload");
    } else {
      return redirect('/');
    }
  }
  



}
