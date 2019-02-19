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
    return view('index');
});

Route::get('/ingresar', function () {
    if(Auth::check()){return Redirect::to('admin');}
    return view('login');
})->name('ingresar');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');

Route::get('/{test}', 'GroupController@index')->name('grupo');

Route::post('/code', 'GroupController@code')->name('group_code');

Route::get('/files/{file}', 'GroupController@download')->name('descargar');

Route::get('admin/files/{file}', 'AdminController@download')->name('descargar_admin');

Route::post('/admin/grupos/store', 'AdminController@storeGroup')->name('groups_store')->middleware('auth');

Route::post('/admin/grupos/delete', 'AdminController@deleteGroup')->name('groups_delete')->middleware('auth');

Route::post('/admin/files/delete', 'AdminController@deleteFile')->name('files_delete')->middleware('auth');

Route::post('/admin/archivos/store', 'AdminController@storeFile')->name('files_store')->middleware('auth');


