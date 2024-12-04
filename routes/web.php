<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
Route::get('','Admin\Auth\AdminController@getLoginAdmin');

include('route-admin.php');
Auth::routes();
