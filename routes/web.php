<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth' , 'middleware' => 'guest', 'controller' => AuthController::class], function () {
    Route::get('login','login')->name('login');
    Route::post('login','authenticate');

    Route::get('forgot', 'forgot')->name('forgot');
    Route::post('forgot', 'reset')->name('reset');

    Route::get('reset', 'resetForm')->name('resetForm');
    Route::post('reset', 'update')->name('update');
});



