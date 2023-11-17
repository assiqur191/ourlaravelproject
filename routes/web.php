<?php

use App\Http\Controllers\HomePage;
use App\Http\Controllers\AboutPage;
use App\Http\Controllers\SinglePost;
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

Route::get('/', [HomePage::class,"homepage"] );
Route::get('/users',[AboutPage::class,"aboutpage"])->name("about");
// Route::get('profile/{name}/{userid}',[SinglePost::class,"singlepost"])->name("profile");
Route::get('profile/{id}',[SinglePost::class,"singlepost"])->name("profile");
Route::get('/singlepost',[SinglePost::class,"singlepost"]);
Route::post('/register',[UserController::class,"register"]);
?>