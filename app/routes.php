<?php

Route::get('/','FrasesController@index');
Route::resource('frases','FrasesController');

Route::group(array('prefix' => 'v1'), function()
{
    Log::info($_SERVER['REMOTE_ADDR']);
    /**
     * API - Contactos
    | GET|HEAD v1/frases
    | GET|HEAD v1/frases/{frases}
    | POST v1/frases
     */
    Route::get('frases/paginadas',['as'=>'v1.frases.paginadas','uses'=>'FrasesApiController@showWithPaginate']);
    Route::resource('frases','FrasesApiController',['only'=>['index','show','store']]);
});