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

Route::get('/admin/dashboard', 'DashboardController@index');


//toga
Route::get('/admin/toga', 'togaController@tampil');
Route::post('/admin/toga', 'togaController@tambah');
Route::put('/admin/toga', 'togaController@ubah');
Route::delete('/admin/toga', 'togaController@hapus');

//todat
Route::get('/admin/todat', 'todatController@tampil');
Route::post('/admin/todat', 'todatController@tambah');
Route::put('/admin/todat', 'todatController@ubah');
Route::delete('/admin/todat', 'todatController@hapus');

//tomas
Route::get('/admin/tomas', 'tomasController@tampil');
Route::post('/admin/tomas', 'tomasController@tambah');
Route::put('/admin/tomas', 'tomasController@ubah');
Route::delete('/admin/tomas', 'tomasController@hapus');

//etnis
Route::get('/admin/etnis', 'etnisController@tampil');
Route::post('/admin/etnis', 'etnisController@tambah');
Route::put('/admin/etnis', 'etnisController@ubah');
Route::delete('/admin/etnis', 'etnisController@hapus');

//asing
Route::get('/admin/asing', 'asingController@tampil');
Route::post('/admin/asing', 'asingController@tambah');
Route::put('/admin/asing', 'asingController@ubah');
Route::delete('/admin/asing', 'asingController@hapus');

//Forum&LSM
Route::get('/admin/konflik', 'konflikController@tampil');
Route::post('/admin/konflik', 'konflikController@tambah');
Route::put('/admin/konflik', 'konflikController@ubah');
Route::delete('/admin/konflik', 'konflikController@hapus');

//Forum&LSM
Route::get('/admin/forum', 'forumController@tampil');
Route::post('/admin/forum', 'forumController@tambah');
Route::put('/admin/forum', 'forumController@ubah');
Route::delete('/admin/forum', 'forumController@hapus');

//pengurus Forum&LSM
Route::get('/admin/pengurus-forum/{id}', 'forumController@tampilPengurus');
Route::post('/admin/pengurus-forum/{id}', 'forumController@tambahPengurus');
Route::put('/admin/pengurus-forum/{id}', 'forumController@ubahPengurus');
Route::delete('/admin/pengurus-forum/{id}', 'forumController@hapusPengurus');

//agama
Route::get('/admin/agama', 'agamaController@tampil');
Route::post('/admin/agama', 'agamaController@tambah');
Route::put('/admin/agama', 'agamaController@ubah');
Route::delete('/admin/agama', 'agamaController@hapus');

//aliran
Route::get('/admin/aliran', 'aliranController@tampil');
Route::post('/admin/aliran', 'aliranController@tambah');
Route::put('/admin/aliran', 'aliranController@ubah');
Route::delete('/admin/aliran', 'aliranController@hapus');

//kecamatan
Route::get('/admin/kecamatan', 'kecamatanController@tampil');
Route::post('/admin/kecamatan', 'kecamatanController@tambah');
Route::put('/admin/kecamatan', 'kecamatanController@ubah');
Route::delete('/admin/kecamatan', 'kecamatanController@hapus');

//pengurus-kecamatan
Route::get('/admin/pengurus-kecamatan/{id}', 'kecamatanController@tampilPengurus');
Route::post('/admin/pengurus-kecamatan/{id}', 'kecamatanController@tambahPengurus');
Route::put('/admin/pengurus-kecamatan/{id}', 'kecamatanController@ubahPengurus');
Route::delete('/admin/pengurus-kecamatan/{id}', 'kecamatanController@hapusPengurus');

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

// SLIDER
Route::get('admin/slider', 'SliderController@index');
Route::post('admin/slider', 'SliderController@store');
Route::put('admin/slider', 'SliderController@update');
Route::delete('admin/slider', 'SliderController@destroy');

// GALLERY
Route::get('admin/gallery', 'GalleryController@index');
Route::post('admin/gallery', 'GalleryController@store');
Route::put('admin/gallery', 'GalleryController@update');
Route::delete('admin/gallery', 'GalleryController@destroy');

// ABOUT
Route::get('admin/about', 'AboutController@index');
Route::put('admin/about', 'AboutController@update');