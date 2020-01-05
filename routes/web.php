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

Route::get('aulas',['as'=> 'aulas', 'uses' => 'Aulas@index']);

Route::get('pedidosdesala',['as'=> 'pedidosdesala', 'uses' => 'PedidosDeSala@index']);

Route::get('frequencias',['as'=> 'frequencias', 'uses' => 'Frequencias@index']);

Route::get('gerirutilizadores',['as'=> 'gerirutilizadores', 'uses' => 'GerirUtilizadores@index']);

Route::get('docentelecionacadeira',['as'=> 'docentelecionacadeira', 'uses' => 'DocenteLecionaCadeira@index']);

Route::get('gestaoCursos',['as'=> 'gestaoCursos', 'uses' => 'GestaoCursos@index']);

Route::get('gestaoCadeiras',['as'=> 'gestaoCadeiras', 'uses' => 'GestaoCadeiras@index']);

Route::get('cursos',['as'=> 'cursos', 'uses' => 'AlunosCursos@index']);

Route::post('api/settings', ['as'=> 'api_settings', 'uses' => 'Settings@changePassword']);

Route::post('api/edit_user', ['as'=> 'api_edit_user', 'uses' => 'EditarUtilizador@editUser']);

Route::post('api/delete_curso',['as'=> 'api_delete_curso', 'uses' => 'AlunosCursos@deleteCurso']);

Route::post('api/add_curso',['as'=> 'api_add_curso', 'uses' => 'AlunosCursos@addCurso']);

Route::post('api/add_user', ['as'=> 'api_add_user', 'uses' => 'GerirUtilizadores@addUser']);

Route::post('api/add_cadeira', ['as'=> 'api_add_cadeira', 'uses' => 'GestaoCadeiras@add_cadeira']);

Route::post('api/remove_cadeira', ['as'=> 'api_remove_cadeira', 'uses' => 'GestaoCadeiras@remove_cadeira']);

Route::post('api/alterar_cadeira', ['as'=> 'api_alterar_cadeira', 'uses' => 'GestaoCadeiras@update_cadeira']);
//Adicionar, alterar e remover cursos
Route::post('api/add_curso_to_db', ['as'=> 'api_add_curso_db', 'uses' => 'GestaoCursos@add_curso']);
Route::post('api/alterar_curso_db', ['as'=> 'api_alterar_curso_db', 'uses' => 'GestaoCursos@change_curso']);
Route::post('api/remove_curso_db', ['as'=> 'api_remove_curso_db', 'uses' => 'GestaoCursos@remove_curso']);

Route::post('api/criar_frequencia', ['as'=> 'api_criar_frequencia', 'uses' => 'Frequencias@add_frequencia']);
Route::post('api/delete_frequencia', ['as'=> 'api_delete_frequencia', 'uses' => 'Frequencias@delete_frequencia']);


Route::post('api/criar_aula', ['as'=> 'api_criar_aula', 'uses' => 'Aulas@add_aula']);
Route::post('api/delete_aula', ['as'=> 'api_delete_aula', 'uses' => 'Aulas@delete_aula']);

Route::post('api/aceitar_rejeitar_sala', ['as'=> 'api_aceitar_rejeitar_sala', 'uses' => 'PedidosDeSala@api_aceitar_rejeitar_sala']);
