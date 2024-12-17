<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaypalController;
use App\Http\Controllers\Api\ImageController;

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

Route::post('/upload/image', [ImageController::class, 'upload']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user/auth/profile', [AuthController::class, 'profile'])->middleware('auth:api');
Route::post('/login', [AuthController::class, 'login']);
Route::put('/user/auth/change-password', [AuthController::class, 'changePassWord'])->middleware('auth:api');
Route::put('/user/auth/profile', [AuthController::class, 'update'])->middleware('auth:api');

Route::group(['namespace'=>'Api'], function () {
    Route::get('/dashboard','HomeController@index');
    Route::get('/category','CategoryController@index');
    Route::get('danh-muc/{slug}','CategoryDetailController@getCategoryDetail');
    Route::get('product','ProductController@list');
    Route::get('san-pham','ProductController@index');
    Route::get('product/show/{slug}','ProductDetailController@getProductDetail');

    Route::prefix('order')->group(function(){
        Route::get('','ShoppingCartController@index');
        Route::post('add/{id}','ShoppingCartController@add');
        Route::patch('update/{id}','ShoppingCartController@update');
        Route::delete('delete/{id}','ShoppingCartController@delete');
        Route::post('pay','ShoppingCartController@postPay');
    });
    Route::group(['middleware'=>'auth:api','prefix'=>'transaction'],function(){
        Route::post('store','TransactionController@postPay');
        Route::put('status/{id}','TransactionController@status');
    });
    Route::group(['middleware'=>'auth:api','prefix'=>'rating'],function(){
        Route::get('','UserRatingController@index');
        Route::post('store','UserRatingController@store');
    });
    Route::group(['middleware'=>'auth:api','prefix'=>'voucher'],function(){
        Route::get('','VoucherController@index');
        Route::get('detail','VoucherController@detail');
    });
    Route::prefix('menu')->group(function(){
        Route::get('','MenuController@index');
    });
    Route::get('payment/transaction/callback','TransactionController@callback');
});
