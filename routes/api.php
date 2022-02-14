<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::post("/register", [MainController::class, "register"]);

Route::get('user/verify/{verification_code}', [MainController::class, 'verifyUser']);

Route::post("/login", [MainController::class, "login"]);

Route::post('/recover', [MainController::class,'recover_password']); //Password recovery API

Route::post('/reset', [MainController::class,'password_reset']);

Route::get('password/reset/', [MainController::class, 'password_recover']);

Route::get('user/delete/{id}', [MainController::class, 'delete']);

Route::get('user/{id}', [MainController::class, 'userDetails']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
