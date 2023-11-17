<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutPage extends Controller
{
    public function aboutpage(Request $request){

        $pets= ['josim','balod','kgf'];
        //echo $request->id;
        $data = [
            ['id'=>1,'name'=>'Sayem'],
            ['id'=>2,'name'=>'Shaikat'],
            ['id'=>3,'name'=>'Dipto']
        ];

        return view('aboutpage',['users'=> $data]);
    }
}
