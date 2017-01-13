<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware'=>['auth'],'namespace'=>'Admin','prefix'=>'admin'], function(){
    Route::get('index','IndexController@index');
    Route::get('/info','IndexController@info');
    Route::any('/pass','IndexController@pass');

    Route::group(['prefix'=>'category'],function(){
        Route::get('/index','CategoryController@index');
        Route::get('/create','CategoryController@create');
        Route::post('/store','CategoryController@store');
        Route::post('/delete','CategoryController@delete');
        Route::get('/{id}/edit','CategoryController@edit');
        Route::post('/{id}','CategoryController@update');
        Route::post('/changeorder','CategoryController@changeOrder');
    });
    /**
     * 资源路由，已包含增删改查
     */
    Route::resource('/article','ArticleController');

    Route::resource('/config','ConfigController');
    Route::post('config/updatecontent', 'ConfigController@updatecontent');
    Route::post('config/changeorder', 'ConfigController@changeOrder');


    Route::resource('/links','LinksController');
    Route::post('/link/changeorder','LinksController@changeOrder');

    Route::any('/upload','PublicController@upload');



});
