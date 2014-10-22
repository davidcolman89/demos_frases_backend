<?php

Route::get('/','FrasesController@index');
Route::resource('frases','FrasesController');

Route::group(array('prefix' => 'v1'), function()
{

    /**
     * API - Contactos
    | GET|HEAD v1/frases
    | GET|HEAD v1/frases/{frases}
    | POST v1/frases
     */
    #Route::get('frases/{frases}/type/{type}',['as'=>'frases.show.type','uses'=>'FrasesApiController@show']);
    Route::resource('frases','FrasesApiController',['only'=>['index','show','store']]);
});