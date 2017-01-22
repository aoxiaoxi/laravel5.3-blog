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
Route::group(['namespace'=>'Home'], function(){

    Route::get('/','IndexController@index');
    Route::get('/cate/{cate_id?}','IndexController@cate');
    Route::get('/article/{art_id?}','IndexController@art');
    Route::post('/indexMore','IndexController@indexMore');
    Route::post('/cateMore','IndexController@cateMore');
    Route::get('/about','IndexController@about');
    Route::post('/zan/{art_id}','IndexController@zan');
    Route::post('/search','IndexController@sou');




});
