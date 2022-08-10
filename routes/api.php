<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\BranchController;

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

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
Route::post('forgotPassword', [AuthController::class, 'forgot_password']);
Route::post('verifyOtp', [AuthController::class, 'verify_otp']);
Route::post('resetPassword', [AuthController::class, 'reset_password']);
Route::get('send-email', [AuthController::class, 'sendmail']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group( function () {
    Route::post('updateProfile', [AuthController::class, 'update_profile']);


    Route::get('getCategories', [CategoryController::class, 'get_categories']);
    Route::post('getProductsByCategory', [ProductController::class, 'get_product_by_category']);
    Route::post('createOrder', [OrderController::class, 'create_order']);


    Route::get('getOrders', [OrderController::class, 'index']);
    Route::post('changeOrderStatus', [OrderController::class, 'change_order_status']);



    Route::get('getBranches', [BranchController::class, 'index']);
});
