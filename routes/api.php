<?php

use Illuminate\Http\Request;
use App\categorys;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/admin/category', function (Request $request) {
	$categorys = categorys::all();
    return $categorys;
})->middleware('auth:api');
