<?php

use App\Http\Controllers\DailyNutritionController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NutritionFactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticateAPI;
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
Route::post('/is-emaill-exist', [RegisterController::class, 'checkEmail']);

// login user
Route::post('/login',[LoginController::class, 'login']);

// find account
Route::post('/find', [UserController::class, 'find']);

// user collection data
Route::get('/all-users', [UserController::class, 'index']);

// delete user account
Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

// update user account
// Route::middleware([AuthenticateAPI::class])->group(function () {
// });
Route::post('/update-user/{id}', [UserController::class, 'update'])->middleware([AuthenticateAPI::class]);

// store food
Route::post('/store-food', [FoodController::class, 'store']);

// store nutrition fact
Route::post('/store-nutrifact', [NutritionFactController::class, 'store']);

// store daily nutrition
Route::post('/store-dailynut', [DailyNutritionController::class, 'store']);

// get daily nutrition data by user id
Route::get('/get-dailynut/{userId}', [DailyNutritionController::class, 'findByUserId']);

// attach daily nut food
Route::post('/attach-dailynut-food', [DailyNutritionController::class, 'attachDailyNutFood']);

// update daily nut by food
Route::post('/update-dailynut-by-food/{dailyNutId}', [DailyNutritionController::class, 'updateDailyNutByFood']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
