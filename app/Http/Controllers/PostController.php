<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Post;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function showCreateForm(){
      if(auth()){
        return view("create-post");
      }
      else{
        redirect('/');
      }

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
    
     public function viewPostById($user_id){
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
       public function avatarUploadPage(){
          if(auth()->check()){
            return view("avatarupload");
         }
        else{
              return redirect('/');
              }
}
     public function avatarUpload(Request $request){
      
         
                                                    $request->validate([
                                                     'image'=> ['required','image','mimes:jpeg,png,jpg,gif|max:2048']
                                                      ]);
                                                      $user = Auth::user();
                                                      //save the image to the storage folder in the pc
                                                      $imagePath= $request->file('image')->storeAs("public/images/{$user->id}",$request->file('image')->hashName());
                                                       // updating the user avatar column with image path
                                                       $user->avatar =$imagePath;
                                                    
                                                       $user-> save;
                                                       $avatar = new Avatar([
                                                        'path' => $imagePath
                                                    ]);
                                                
                                                    // Associate the avatar with the user
                                                    $user->avataruser()->save($avatar);
                                                
                                                    // Retrieve the latest avatar path
                                                    $latestAvatarPath = $user->avataruser()->latest()->value('path');
                                                      
                                                       return redirect('/')->with('success','Image upload successfully')->with('latestAvatarPath', $latestAvatarPath);
                                                     

        

     }
     
     
     
}
