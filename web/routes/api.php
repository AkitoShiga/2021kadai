<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ImageApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::post('/register', 'Auth\RegisterController@sendMail')->name('register');
Route::post('/register', [RegisterController::class, 'sendMail']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/user', function() {
    return Auth::user();
})->name('user');
Route::get('/refresh-token', function(Illuminate\Http\Request $request) {
    $request->session()->regenerateToken();
    return response()->json();
})->name('refresh-token');
Route::get('/images', [ImageApiController::class, 'getImage']);
Route::post('/images', [ImageApiController::class, 'store']);