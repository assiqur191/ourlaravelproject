<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// user related route
Route::get('/', [UserController::class,"showCorrectHomepage"] );
//Route::get('/users',[AboutPage::class,"aboutpage"])->name("about");
// Route::get('profile/{name}/{userid}',[SinglePost::class,"singlepost"])->name("profile");
//Route::get('profile/{id}',[SinglePost::class,"singlepost"])->name("profile");
//Route::get('/singlepost',[SinglePost::class,"singlepost"]);
Route::post('/register',[UserController::class,"register"]);
Route::post('/login',[UserController::class,"login"]);
Route::post('/logout',[UserController::class,"logout"]);

// blog related route
Route::get("/create-post",[PostController::class,'showCreateForm']);
Route::post("/create-post",[PostController::class,'storeNewPost']);
?>