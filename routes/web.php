<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('reviews', ReviewController::class);
Route::resource('/', ReviewController::class);


// Route::get('/', function () {
//     return view('welcome');
// });
