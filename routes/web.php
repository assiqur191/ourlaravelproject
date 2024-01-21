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
Route::get('/', [UserController::class,"showCorrectHomepage"] )->name('login');
//Route::get('/users',[AboutPage::class,"aboutpage"])->name("about");
// Route::get('profile/{name}/{userid}',[SinglePost::class,"singlepost"])->name("profile");
//Route::get('profile/{id}',[SinglePost::class,"singlepost"])->name("profile");
//Route::get('/singlepost',[SinglePost::class,"singlepost"]);
Route::post('/register',[UserController::class,"register"])->middleware('guest');
Route::post('/login',[UserController::class,"login"]);
Route::post('/logout',[UserController::class,"logout"]);

// blog related route
Route::get("/create-post",[PostController::class,'showCreateForm'])->middleware('auth');
Route::post("/create-post",[PostController::class,'storeNewPost'])->name('login');
Route::get("/post/{post}",[PostController::class,'viewSinglePost'])->middleware('mustBeLogin');
Route::delete("/post/{post}",[PostController::class,'delete'])->middleware('mustBeLogin')->middleware('can:delete,post');
Route::get("/post/{post}/edit",[PostController::class,'showEditPost'])->middleware('mustBeLogin');
Route::put("/post/{post}",[PostController::class,'updatePost'])->middleware('mustBeLogin')->middleware('can:update,post');


// profile related route

Route::get("/profile/{user:username}",[UserController::class,'userProfile'])->middleware('mustBeLogin');
Route::get("/viewpost/{user_id}",[PostController::class,'viewPostById'])->middleware('mustBeLogin');
Route::get("/avatarupload",[PostController::class,'avatarUploadPage'])->middleware('mustBeLogin');
Route::post("/avatarupload",[PostController::class,'avatarUpload'])->middleware('mustBeLogin');



?>