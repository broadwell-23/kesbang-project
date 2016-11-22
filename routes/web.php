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

Route::get('/', 'WebController@index');

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

//menu
Route::get('/admin/menu', 'menuController@tampil');
Route::post('/admin/menu', 'menuController@tambah');
Route::put('/admin/menu', 'menuController@ubah');
Route::delete('/admin/menu', 'menuController@hapus');

//category
Route::get('/admin/category', 'categoryController@tampil');
Route::get('/admin/category-data', 'categoryController@data');
Route::post('/admin/category', 'categoryController@tambah');
Route::put('/admin/category', 'categoryController@ubah');
Route::delete('/admin/category', 'categoryController@hapus');

//page
Route::get('admin/page','pageController@tampil');
Route::get('/admin/page-data', 'pageController@data');
Route::delete('admin/page','pageController@hapus');
Route::get('admin/new-page','pageController@dataNew');
Route::post('admin/new-page','pageController@tambah');
Route::get('/admin/edit-page/{id}', 'pageController@editNew');
Route::post('/admin/edit-page/{id}', 'pageController@ubah');

//post
Route::get('/admin/post', 'postController@tampil');
Route::delete('/admin/post', 'postController@hapus');
Route::get('/admin/new-post', 'postController@dataNew');
Route::post('/admin/new-post', 'postController@tambah');
Route::get('/admin/edit-post/{id}', 'postController@editNew');
Route::post('/admin/edit-post/{id}', 'postController@ubah');

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


