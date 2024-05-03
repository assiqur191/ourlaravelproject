<?php

namespace App\Http\Controllers;


use App\Events\OurExampleEvent;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;



class UserController extends Controller
{
    
    //
    public function register(Request $request)
    {
        $incomingField = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'password' => ['required', 'min:6', 'confirmed'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
        ]);
        $incomingField['password'] = bcrypt($incomingField['password']);
        $user = User::create($incomingField);
        auth()->login($user);

       // event(new Registered(['username'=> auth()->user()->username,'action'=>'registerd']));

        return redirect('/')->with('success', 'Thanks for your registration');
    }
    public function logout()
    {
        event(new OurExampleEvent(['username'=> auth()->user()->username ,'action'=>'logout']));
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out');

    }
   
    public function login(Request $request)
    {
        $incomingField = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);
        if (auth()->attempt(['username' => $incomingField['loginusername'], 'password' => $incomingField['loginpassword']])) {
            $request->session()->regenerate();
            event(new OurExampleEvent(['username'=> auth()->user()->username ,'action'=>'login']));
            return redirect('/')->with('success', 'You are successfully logged in');

        } else {
            return redirect('/')->with('failure', 'Invalid login');
        }

    }

    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('homepage-feed',['posts'=> auth()->user()->postFeed()->latest()->paginate(5)]);
        } else {
            return view('homepage');
        }
    }
    // making profile page  alive
    private function getSharedData($user){
        $isFollowing=0;
        $isFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();
        $data = [
            'isfollowing' => $isFollowing,
            'username' => $user->username,
            'avatar' => $user->avatar,
            'postCount' => $user->posts()->count(),
            'followersCount' => $user->followers()->count(),
            'followingCount' =>$user->followingTheseUser()->count()
        ];
        //  View::share('sharedData',['isfollowing' => $isFollowing, 'username' => $user->username, 'avatar' => $user->avatar, 'postCount' => $user->posts()->count()]);
        // print_r($data); 
         View::share('sharedData',$data);
       // return ['isfollowing' => $isFollowing, 'username' => $user->username, 'avatar' => $user->avatar, 'postCount' => $user->posts()->count()];
    }
    public function userProfile(User $user)
    {
        // $imagePath = new $imagePath;
        $this->getSharedData($user);
        
         return view('profile',[ 'posts' => $user->posts()->latest()->get()] );


    }
    public function profileFollowers(User $user)
    {
        // $isFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();


        // return view('profile-followers', ['isfollowing' => $isFollowing, 'username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'avatar' => $user->avatar, 'postCount' => $user->posts()->count()]);
        $this->getSharedData($user);

        
        //return ['following' =>$user->followers()->latest()->get()] ;

        return view('profile-followers',[ 'followers' =>$user->followers()->latest()->get()] );




    }
    public function ProfileFollowing( User $user)
    {
        // $isFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();


        // return view('profile-following', ['isfollowing' => $isFollowing, 'username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'avatar' => $user->avatar, 'postCount' => $user->posts()->count()]);
        $this->getSharedData($user);

        

// $datacheck = $user->followingTheseUser()->latest()->get();
// foreach($datacheck as $data){
//     print_r($data);
//     echo ("</br>");
// }
        return view('profile-following',[ 'following' => $user->followingTheseUser()->latest()->get()] );


    }
    public function avatarUpload(User $user, Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);




        //////////////////
        $user = auth()->user();
        if ($request->has('image')) {
            $file = $request->file('image');

            $extension = $file->extension();
            $imageName = time() . '.' . $user->id . '.' . $extension;

            $file->move('public/image/', $imageName);

        }



        $userAvatar = User::find($user->id);
        $userAvatar->avatar = $imageName;
        $userAvatar->save();




        return back()->with('success', 'Image uploaded successfully.');
        //->with('image',$image)->with('imagepath',$imagePath)

    }
}
