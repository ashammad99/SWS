<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChildMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/store-location',[ChildMobileController::class,'store_location'])
    ->middleware('auth:sanctum');

Route::get('/search/{code}',[ChildMobileController::class,'search_child'])
    ->middleware('auth:sanctum');

Route::get('/getImage/{child_id}',[ChildMobileController::class,'getImage'])
    ->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout/{id}', [AuthController::class, 'logout']);



