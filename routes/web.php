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

Route::get('/', function () {
    return "Mapa Interativo";
});

Route::group(['prefix'=>'app'],function(){
    
    Route::post('login','AppsController@login');
    Route::post('register','AppsController@register');
    Route::get('connected/{uuid}','AppsController@connected');
    Route::get('logout/{uuid}','AppsController@logout');
    Route::get('markers','MarkersController@select');
    Route::get('map','TroublesController@map');
    
    Route::group(['prefix'=>'troubles', 'middleware'=>'auth'],function(){
       Route::get('','TroublesController@index');
       Route::post('store','TroublesController@store');
       Route::get('all','TroublesController@all');
       Route::get('edit/{id}', 'TroublesController@edit');
       Route::post('update', 'TroublesController@update');
       
       Route::group(['prefix'=>'photos'],function(){ // Verificar necessidade de incluir middleware Auth
           Route::get('{id}', 'TroublePhotosController@index');
           Route::get('destroy/{id}', 'TroublePhotosController@destroy');
           Route::get('total/{id}', 'TroublePhotosController@total');
           Route::post('upload', 'TroublePhotosController@upload');
       });
       
    });
    
});

Auth::routes();

Route::group(['prefix'=>'admin','middleware'=>['auth.admin','auth'],'where'=>['id'=>'[0-9]+']],function(){
     
    Route::get('',['as' => 'home', 'uses' => 'HomeController@index']);
     
    Route::group(['prefix'=>'markers'],function (){
         
         Route::get('',['as' => 'markers.index', 'uses' => 'MarkersController@index']);
         Route::get('create',['as' => 'markers.create', 'uses' => 'MarkersController@create']);
         Route::post('store', ['as' => 'markers.store', 'uses' => 'MarkersController@store']);
         Route::put('update', ['as' => 'markers.update', 'uses' => 'MarkersController@update']);
         Route::get('destroy/{id}',['as' => 'markers.destroy', 'uses' => 'MarkersController@destroy']);
         Route::get('edit/{id}',['as' => 'markers.edit', 'uses' => 'MarkersController@edit']);
         
     });
     
});




