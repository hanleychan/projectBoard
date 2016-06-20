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


Route::auth();

Route::get('/', 'ProjectController@index');
Route::get('/browse', 'ProjectController@browse');
Route::get('/newProject', 'ProjectController@newProject');
Route::post('/processPostProject', 'ProjectController@processNewProject');
Route::get('/messages', 'ProjectController@messages');
Route::get('/myProjects', 'ProjectController@myProjects');