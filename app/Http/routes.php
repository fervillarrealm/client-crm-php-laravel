<?php

Route::group(['middlewareGroups' => 'web'], function () {

    Route::get('/login', [
        'uses'  => 'LoginController@getLogin',
        'as'    => 'login'
    ]);
    
     Route::post('/postLogin', [
        'uses'  => 'LoginController@postLogin',
        'as'    => 'postLogin'
    ]);
    
    Route::get('/test', function (){
        return view('test');
    });
    
    /*  AUTH
    ===============================================================*/
    Route::group(['middleware' => 'auth'], function() {
        
        Route::get('/logout', [
           'uses'   => 'LoginController@GetLogout',
           'as'     => 'logout'
        ]);
        
        Route::get('/home', [
           'uses'   => 'HomeController@index',
           'as'     => 'home'
        ]);
        
    });
});