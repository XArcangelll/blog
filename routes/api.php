<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->post('/leopoldo', function (Request $request) {
    return $request->user();
});

Route::post('registerUser',[AuthController::class,'create']);
Route::post('loginUser',[AuthController::class,'login']);


Route::get('tags',[TagController::class,'index']);
Route::get('tags/{id}',[TagController::class,'show']);
Route::post('tags',[TagController::class,'store']);
Route::put('tags/{tag}',[TagController::class,'update'])->missing(function(){
    return response()->json(['data' => null], 404);
});
Route::delete('tags/{tag}',[TagController::class,'destroy'])->missing(function(){
    return response()->json(['data' => null], 404);
});


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});