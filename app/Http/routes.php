<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('person', ['as' => 'person', 'uses' => 'HomeController@person']);
Route::post('person/store', ['as' => 'person.store', 'uses' => 'HomeController@store']);
Route::get('person/edit/{id}', ['as' => 'person.edit', 'uses' => 'HomeController@edit']);
Route::post('person/update/{id}', ['as' => 'person.update', 'uses' => 'HomeController@update']);
Route::post('person/delete/{id}', ['as' => 'person.delete', 'uses' => 'HomeController@destroy']);