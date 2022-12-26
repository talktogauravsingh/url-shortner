<?php

use App\Http\Controllers\UrlShortnerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

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

Route::get('/testing', function(){
    dd(Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]));
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('signup', function () {
    return view('signup');
})->name('signup');

Route::post('signup', [UserController::class, 'signup']);
Route::post('login', [UserController::class, 'login']);
Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('generate-url', [UrlShortnerController::class, 'getShortUrl']);
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('/{prefix}', [UrlShortnerController::class, 'urlGateway']);



