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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('settings',['as'=> 'settings', 'uses' => 'Settings@index']);

Route::get('frequencias',['as'=> 'frequencias', 'uses' => 'Frequencias@index']);

Route::get('gerirutilizadores',['as'=> 'gerirutilizadores', 'uses' => 'GerirUtilizadores@index']);

Route::get('cursos',['as'=> 'cursos', 'uses' => 'AlunosCursos@index']);

Route::post('api/settings', ['as'=> 'api_settings', 'uses' => 'Settings@changePassword']);

Route::post('api/edit_user', ['as'=> 'api_edit_user', 'uses' => 'EditarUtilizador@editUser']);

Route::post('api/delete_curso',['as'=> 'api_delete_curso', 'uses' => 'AlunosCursos@deleteCurso']);

Route::post('api/add_curso',['as'=> 'api_add_curso', 'uses' => 'AlunosCursos@addCurso']);
