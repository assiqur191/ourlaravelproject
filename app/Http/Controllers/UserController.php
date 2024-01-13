<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/')->with('success','You are now logged out');
       
    }
    public function showCorrectHomepage(){
        if(auth()->check()){
            return view('homepage-feed');
        }
        else{
            return view('homepage');
        }
    }
    public function login(Request $request){
        $incomingField = $request->validate([
            'loginusername'=>'required',
            'loginpassword'=>'required'
        ]);
        if(auth()->attempt(['username'=>$incomingField['loginusername'],'password'=> $incomingField['loginpassword']])){
           $request->session()->regenerate();
            return redirect('/')->with('success','You are successfully logged in');

        }
        else{
            return redirect('/')->with('failure','Invalid login');
        }

    }

    //
    public function register(Request $request){
        $incomingField = $request->validate([
         'username' => ['required','min:3','max:20',Rule::unique('users','username')],
         'password'=> ['required','min:6','confirmed'],
         'email'=> ['required','email',Rule::unique('users','email')]
        ]);
        $incomingField['password'] = bcrypt($incomingField['password']);
        $user = User::create($incomingField);
        auth()->login($user);

        return redirect('/')->with('success','Thanks for your registration');
    }
    public function userProfile(){
        if (auth()->check()) {
            $user = auth()->user();
            return view('profile', ['user' => $user]);
        } else {
            return view('unauthenticated');
        }
        

    }
}
