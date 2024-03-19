<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function createFollow($username){
     
     $user = User::where('username', $username)->first();
      


    

    // you can't follow when you alredy follow
    $ifexists= Follow::where([['user_id','=',auth()->user()->id],['followeduser','=',$user->id]])->count();

    if($ifexists){
        return back()->with('failure','You Are Alredy Following this PERSON');

    }
    // you can't follow yourself
    // if($user->id = auth()->user()->id){
    //     return back()->with('failure','You Can not follow your self bosdike');

    // }
    
    // creater follow for all users
    $newFollow = new Follow();
    $newFollow->user_id = auth()->user()->id;
    
    $newFollow->followeduser = $user->id;
    $newFollow->save();

   return back()->with('success','You Are Now Following That Persone');

    }
    public function removeFollow($username){
        $user = User::where('username', $username)->first();
        Follow::where([['user_id','=',auth()->user()->id],['followeduser','=',$user->id]])->delete();
        return back()->with('success','You Unfollow This person');

    }
}
