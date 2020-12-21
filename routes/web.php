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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// トップページ
Route::get('/', function () {
    return view('dashboard');
});


// 全ユーザ閲覧可能
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    Route::get('/user', 'UserController@index')->name('user.index');
    Route::get('/project', 'ProjectController@index')->name('project.index');
});


// 管理者以上
Route::group(['middleware' => ['auth', 'can:system-only']], function () {

    // ユーザー
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user', 'UserController@store')->name('user.store');
    Route::get('/user/{user}/edit/', 'UserController@edit')->name('user.edit');
    Route::put('/user/{user}', 'UserController@update')->name('user.update');
    Route::post('/user/{user}', 'UserController@destroy')->name('user.destroy');

    // 案件
    Route::get('/project/create', 'ProjectController@create')->name('project.create');
    Route::post('/project', 'ProjectController@store')->name('project.store');
    Route::get('/project/{project}/edit/', 'ProjectController@edit')->name('project.edit');
    Route::put('/project/{project}', 'ProjectController@update')->name('project.update');
    Route::post('/project/{project}', 'ProjectController@destroy')->name('project.destroy');
});
