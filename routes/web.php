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

//Route::get('/', function () {
//    return view('welcome');
//});



Route::group(['middleware' => 'web'], function (){
    //登录和登出
    Route::any('guanli','Admin\IndexController@index');
    Route::any('tuichu','Admin\IndexController@out');
    //后台首页
    Route::any('admin/index','Admin\TbController@index')->middleware('login');
    Route::any('admin/info','Admin\TbController@info')->middleware('login');
    //博主简介
    Route::any('blogger','Admin\AboutController@blogger')->middleware('login');
    Route::any('bloggeradd','Admin\AboutController@bloggeradd')->middleware('login');
    Route::any('bloggeredit','Admin\AboutController@bloggeredit')->middleware('login');
    Route::any('bloggerdel','Admin\AboutController@bloggerdel')->middleware('login');
    Route::any('bloggerget_content','Admin\AboutController@bloggerget_content')->middleware('login');
    //新闻管理
    Route::any('news_content','Admin\NewsController@get_content')->middleware('login');
    Route::any('admin/news','Admin\NewsController@show_list')->middleware('login');
    Route::any('admin/newsadd','Admin\NewsController@add')->middleware('login');
    Route::any('admin/newsdel','Admin\NewsController@del')->middleware('login');
    Route::any('admin/newsedit','Admin\NewsController@edit')->middleware('login');
    //相册管理
    Route::any('admin/photo','Admin\PhotoController@show_list')->middleware('login');
    Route::any('admin/photoadd','Admin\PhotoController@add')->middleware('login');
    Route::any('admin/photoedit','Admin\PhotoController@edit')->middleware('login');
    Route::any('admin/photoedel','Admin\PhotoController@del')->middleware('login');

    //分类管理
    Route::any('admin/classify','Admin\ClassifyController@show_list')->middleware('login');
    Route::any('admin/classifyadd','Admin\ClassifyController@add')->middleware('login');
    Route::any('admin/classifydel','Admin\ClassifyController@del')->middleware('login');
    Route::any('admin/classifyedit','Admin\ClassifyController@edit')->middleware('login');


});