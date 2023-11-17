<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    //
    public function register(Request $request){
        $incomingField = $request->validate([
         'username' => ['required','min:3','max:20',Rule::unique('users','username')],
         'password'=> ['required','min:6','confirmed'],
         'email'=> ['required','email',Rule::unique('users','email')]
        ]);
        User::create($incomingField);
        return view("registerpage");
    }
}
