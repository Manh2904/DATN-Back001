<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//admin-auth
Route::group(['prefix' =>'admin-auth','namespace' => 'Admin\Auth'], function() {
    Route::get('login','AdminController@getLoginAdmin')->name('get.login.admin');
    Route::post('login','AdminController@postLoginAdmin');

    Route::get('logout','AdminController@getLogoutAdmin')->name('get.logout.admin');
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    });

Route::group(['prefix'=>'api-admin','namespace'=>'Admin','middleware'=>'check_admin_login'],function(){
    Route::get('','AdminController@index')->name('admin.index');
    //category
    Route::group(['prefix'=>'category'],function(){
        Route::get('','AdminCategoryController@index')->name('admin.category.index');
        Route::get('create','AdminCategoryController@create')->name('admin.category.create');
        Route::post('create','AdminCategoryController@store');
        Route::get('update/{id}','AdminCategoryController@edit')->name('admin.category.update');
        Route::post('update/{id}','AdminCategoryController@update');
        Route::get('delete/{id}','AdminCategoryController@delete')->name('admin.category.delete');
    });
 //product
    Route::group(['prefix'=>'product'],function(){
        Route::get('','AdminProductController@index')->name('admin.product.index');
        Route::get('create','AdminProductController@create')->name('admin.product.create');
        Route::post('create','AdminProductController@store');
        Route::get('update/{id}','AdminProductController@edit')->name('admin.product.update');
        Route::post('update/{id}','AdminProductController@update');
        Route::get('hot/{id}','AdminProductController@hot')->name('admin.product.hot');
        Route::get('active/{id}','AdminProductController@active')->name('admin.product.active');
        Route::get('delete/{id}','AdminProductController@delete')->name('admin.product.delete');
        Route::get('delete-image/{id}','AdminProductController@deleteImage')->name('admin.product.delete_image');
    });

    Route::group(['prefix'=>'user'],function(){
        Route::get('','AdminUserController@index')->name('admin.user.index');
        Route::get('update/{id}','AdminUserController@edit')->name('admin.user.update');
        Route::post('update/{id}','AdminUserController@update');

        Route::get('delete/{id}','AdminUserController@delete')->name('admin.user.delete');
    });
    Route::group(['prefix'=>'qtv'],function(){
        Route::get('','AdminQtvController@index')->name('admin.qtv.index');
        Route::get('create','AdminQtvController@create')->name('admin.qtv.create');
        Route::post('create','AdminQtvController@store');
        Route::get('hot/{id}','AdminQtvController@hot')->name('admin.qtv.hot');
        Route::get('active/{id}','AdminQtvController@active')->name('admin.qtv.active');
        Route::get('update/{id}','AdminQtvController@edit')->name('admin.qtv.update');
        Route::post('update/{id}','AdminQtvController@update');
        Route::get('delete/{id}','AdminQtvController@delete')->name('admin.qtv.delete');
    });
//transaction
    Route::group(['prefix'=>'transaction'],function(){
        Route::get('','AdminTransactionController@index')->name('admin.transaction.index');
        Route::get('delete/{id}','AdminTransactionController@delete')->name('admin.transaction.delete');
        Route::get('guest/{id}','AdminTransactionController@guest')->name('admin.transaction.guest');
        Route::get('order-delete/{id}','AdminTransactionController@deleteOrderItem')->name('ajax.admin.transaction.order_delete');
        Route::get('view-transaction/{id}','AdminTransactionController@getTransactionDetail')->name('ajax.admin.transaction.detail');
        Route::get('action/{action}/{id}','AdminTransactionController@getAction')->name('admin.action.transaction');
    });

    Route::group(['prefix'=>'voucher'],function(){
        Route::get('','AdminVoucherController@index')->name('admin.voucher.index');
        Route::get('create','AdminVoucherController@create')->name('admin.voucher.create');
        Route::post('create','AdminVoucherController@store');
        Route::get('hot/{id}','AdminVoucherController@hot')->name('admin.voucher.hot');
        Route::get('active/{id}','AdminVoucherController@active')->name('admin.voucher.active');
        Route::get('update/{id}','AdminVoucherController@edit')->name('admin.voucher.update');
        Route::post('update/{id}','AdminVoucherController@update');
        Route::get('delete/{id}','AdminVoucherController@delete')->name('admin.voucher.delete');
        Route::get('active/{id}','AdminVoucherController@active')->name('admin.voucher.active');
    });

    Route::get('rating','AdminRatingController@index')->name('admin.rating');
});
