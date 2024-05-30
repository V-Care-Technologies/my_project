<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;


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

Route::post('getOtp', [AuthController::class, 'getOtp']);
Route::post('checkOtp', [AuthController::class, 'checkOtp']);

Route::get('getHomeDetails', [HomeController::class, 'index']);
Route::get('getAllCategory', [HomeController::class, 'getAllCategory']);
Route::post('getSubCategory', [HomeController::class, 'getSubCategory']);
Route::post('getCategoryProductList', [HomeController::class, 'getCategoryProductList']);
Route::post('getProductDetails', [HomeController::class, 'getProductDetails']);
Route::post('addToEnquery', [HomeController::class, 'addToEnquery']);
Route::post('getCartData', [HomeController::class, 'getCartData']);
Route::post('cartItemDelete', [HomeController::class, 'cartItemDelete']);
Route::post('allCartItemDelete', [HomeController::class, 'allCartItemDelete']);
Route::post('updateQty', [HomeController::class, 'updateQty']);
Route::post('placeOrder', [HomeController::class, 'placeOrder']);
Route::post('placeEnquiry', [HomeController::class, 'placeEnquiry']);
Route::get('getVideo', [HomeController::class, 'getVideo']);
Route::post('getOrderDetails', [HomeController::class, 'getOrderDetails']);

