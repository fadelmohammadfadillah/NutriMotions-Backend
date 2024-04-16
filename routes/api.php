<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DailyNutritionController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NutritionFactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticateAdminAPI;
use App\Http\Middleware\AuthenticateAPI;
use App\Models\Admin;
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
Route::post('/login',[LoginController::class, 'login']);

Route::post('/register-admin', [AdminController::class, 'store']);
Route::post('/login-admin',[AdminController::class, 'login']);

Route::middleware('admin-api')->group(function () {
    Route::post('/find', [UserController::class, 'find']);
    Route::get('/all-admins', [AdminController::class, 'index']);
    Route::get('/all-users', [UserController::class, 'index']);
});

Route::middleware([AuthenticateAPI::class])->group(function () {
    Route::post('/update-user/{id}', [UserController::class, 'update']);
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);
    Route::post('/store-food', [FoodController::class, 'store']);

    Route::post('/store-nutrifact', [NutritionFactController::class, 'store']);
    Route::post('/store-dailynut', [DailyNutritionController::class, 'store']);
    Route::get('/get-dailynut/{userId}', [DailyNutritionController::class, 'findByUserId']);
    Route::post('/attach-dailynut-food', [DailyNutritionController::class, 'attachDailyNutFood']);
    Route::post('/update-dailynut-by-food/{dailyNutId}', [DailyNutritionController::class, 'updateDailyNutByFood']);

    Route::post('/show-food', [FoodController::class, 'show']);
    Route::post('/check-food', [FoodController::class, 'checkfood']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
