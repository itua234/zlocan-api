<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('user/verify/{verification_code}', [MainController::class, 'verifyUser']);

Route::get('user/delete/{id}', [MainController::class, 'delete']);

Route::get('user/{id}', [MainController::class, 'userDetails']);

Route::get('password/reset/', [MainController::class, 'password_recover']);





