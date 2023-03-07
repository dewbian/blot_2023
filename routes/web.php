<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/home', function () {
    return view('admin.test');
});

Route::post('ck-editor/image/upload', '\Encore\Admin\Controllers\AdminController@ckEditorUpload')->name('admin.ck-editor.upload');

Route::get('/instagram/feed', 'InstagramController@getFeed')->name('instagram.all');
Route::get('/portfolio', function(){
    return view('port');
});
Route::get('/portfolio1', function(){
    return view('portfolio');
});