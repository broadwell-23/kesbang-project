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

Route::get('/admin', function () {
		if(Auth::check()){
			return redirect('admin/dashboard');
		} else {
    	return view('auth.login');
    }
	});

Route::get('/admin/dashboard', function () {
    return view('dashboard');
});

//category
Route::get('/admin/category', 'categoryController@tampil');
Route::get('/admin/category-data', 'categoryController@data');
Route::post('/admin/category', 'categoryController@tambah');
Route::put('/admin/category', 'categoryController@ubah');
Route::delete('/admin/category', 'categoryController@hapus');

//post
Route::get('/admin/new-post', 'postController@dataNew');
Route::post('/admin/new-post', 'postController@dataNew');
Route::get('/admin/edit-post/{id}', 'postController@editNew');

Route::post('/admin/new-post', 'postController@tambah');

Route::get('/admin/logout', function () {
     Auth::logout();
     return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// USER
Route::get('admin/user', 'UserController@index');
Route::post('admin/user', 'UserController@store');
Route::put('admin/user', 'UserController@update');
Route::delete('admin/user', 'UserController@destroy');


