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

Route::get('/', 'ProjectController@index')->name('index');
Route::get('/browse', 'ProjectController@browse')->name('browse');
Route::get('/project/{project}', 'ProjectController@viewProject')->name('viewProject');
Route::get('/newProject', 'ProjectController@newProject')->name('newProject');
Route::post('/newProject', 'ProjectController@processNewProject')->name('processPostProject');
Route::get('/myProjects', 'ProjectController@myProjects')->name('myProjects');
Route::get('/edit/{project}', 'ProjectController@editPost')->name('editPost');
Route::post('/processEditProject/{project}', 'ProjectController@processEditProject')->name('processEditProject');
Route::delete('/delete/{project}', 'ProjectController@processDeletePost')->name('deletePost');
Route::post('/close/{project}', 'ProjectController@processClosePost')->name('closePost');
Route::get('/archivedProjects', 'ProjectController@archivedProjects')->name('archivedProjects');
Route::get('/repostProject/{project}', 'ProjectController@repostProject')->name('repostPost');

Route::get('/test', function() {
	\DB::table('projects')->where('created_at', '<', new DateTime('60 days ago'))->update(['open' => false]);
	$today = new DateTime('60 days ago');
	var_dump($today);
});