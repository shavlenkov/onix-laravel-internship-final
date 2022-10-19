<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;

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

Route::pattern('user', '[0-9]+');

Route::prefix('auth')->group(function() {
    Route::post('/signup', [AuthController::class, 'postSignup']);
    Route::post('/signin', [AuthController::class, 'postSignin']);
    Route::get('/signout', [AuthController::class, 'getSignout'])->middleware('auth:sanctum');
});

Route::prefix('users')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [UserController::class, 'all']);
    Route::put('/{user}', [UserController::class, 'updateProfile']);
    Route::delete('/{user}', [UserController::class, 'deleteProfile']);

    Route::get('/me', [UserController::class, 'me']);
    Route::put('/me', [UserController::class, 'updateMe']);
});

Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');
Route::apiResource('questions', QuestionController::class)->middleware('auth:sanctum');
Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');

Route::get('/products/{product}/questions', [ProductController::class, 'getQuestions'])->middleware('auth:sanctum');

Route::post('/questions/{id}/answer', [AnswerController::class, 'store'])->middleware('auth:sanctum');
Route::put('/answers/{answer}', [AnswerController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/answers/{answer}', [AnswerController::class, 'destroy'])->middleware('auth:sanctum');

Route::prefix('cart')->middleware('auth:sanctum')->group(function() {
    Route::post('/', [CartController::class, 'store']);
    Route::get('/', [CartController::class, 'index']);
    Route::delete('/', [CartController::class, 'deleteAll']);
    Route::delete('/{cart}', [CartController::class, 'deleteOne']);
});
