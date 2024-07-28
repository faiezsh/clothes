<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ModelSController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * User and company
 */
Route::post('/register', 'App\Http\Controllers\Api\AuthController@Register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/addAdmin', [AuthController::class, 'createUserAdmin']);
Route::get('/showUser', [AuthController::class, 'showUser'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
////////////// service ///////////////////////
Route::post('addService',[ServiceController::class,'addService'])->middleware('auth:sanctum');
///////////////  Model ///////////////////
Route::post('addModel',[ModelSController::class,'addModel'])->middleware('auth:sanctum');
Route::get('get_Model',[ModelSController::class,'get_Model'])->middleware('auth:sanctum');
Route::get('show_Model/{id}',[ModelSController::class,'showModel'])->middleware('auth:sanctum');
///////////////  Image /////////////////////
Route::post('addImage',[ImageController::class,'addImage'])->middleware('auth:sanctum');
Route::get('showPiece',[ImageController::class,'showPiece'])->middleware('auth:sanctum');
Route::get('show/{id}',[ImageController::class,'show'])->middleware('auth:sanctum');
