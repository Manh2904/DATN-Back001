<?php

use Illuminate\Support\Facades\Route;
Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

include('route-admin.php');
Auth::routes();
