<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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

// register user
Route::post('/registers', [RegisterController::class, 'store']);

// login user
Route::post('login',[LoginController::class, 'login']);

// find account
Route::post('/find', [UserController::class, 'find']);

// user collection data
Route::get('/all-users', [UserController::class, 'index']);

// delete user account
Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

// update user account
Route::post('/update-user/{id}', [UserController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
