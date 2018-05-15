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


Route::post('/getgituser','AjaxController@index');

Route::get('/getgituser', function()
{
    return View::make('welcome');
});

Route::post('/getgituser/followers','AjaxController@followers');

Route::get('/getgituser/followers', function()
{
    return View::make('welcome');
});