<?php

Route::group(['middleware' => 'web'], function(){
    
    Route::get('/login', [
        'uses'  => 'LoginController@getLogin',
        'as'    => 'login'
    ]);
    
    Route::get('/test', function (){
        return view('test');
    });
    
    Route::group(['middleware' => 'auth'], function() {
        
    });
});
