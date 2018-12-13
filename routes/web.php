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

//后台首页 
Route::resource("/admin","Admin\AdminController");
// 后台无限极分类
Route::resource("/admincates","Admin\CateController");
// 后台管理员管理
Route::resource("/adminuser","Admin\AdminuserController");