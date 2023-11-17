<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinglePost extends Controller{

    public function singlepost(){
        return view('single-post');
    }
}
