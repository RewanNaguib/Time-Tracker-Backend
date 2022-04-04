<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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

//protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/refresh', [AuthenticationController::class, 'refresh']);


//    Route::get('/test_token_expiration', [AuthenticationController::class, 'testTokenExpiration']);
});

//public Routes
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);


Route::get('/accessor',  [AuthenticationController::class, 'accessor']);
Route::get('/mutator',  [AuthenticationController::class, 'mutator']);
