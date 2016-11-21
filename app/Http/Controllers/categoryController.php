<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categorys;
class categoryController extends Controller
{

    public function data($value='')
    {
        $categorys = categorys::all();
        return $categorys;
    }

    public function tampil()
    {
    	$categorys = categorys::all();
    	return view('category',['categorys'=>$categorys]);
    }

    public function tambah(Request $request)
    {
    	$categorys = new categorys;
    	$categorys->nama = $request->nama;
    	$categorys->save();
    	return redirect()->action('categoryController@tampil');
    }

    public function ubah(Request $request)
    {
    	$categorys = categorys::find($request->id);
    	$categorys->nama = $request->nama;
    	$categorys->save();
    	return redirect()->action('categoryController@tampil');
    }

    public function hapus(Request $request)
    {
    	$categorys = categorys::find($request->id);
    	$categorys->delete();
    	return redirect()->action('categoryController@tampil');
    }
}
