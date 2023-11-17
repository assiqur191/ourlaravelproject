<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePage extends Controller
{
    public function homepage()
    {
        $ourName='sayem';
        $catname='jinish';
        

        return view('homepage');
        //return '<h2>Homepage again!!</h2><a href="/about">view the about page</a>';
  
       

    }
}
