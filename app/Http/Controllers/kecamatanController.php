<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kecamatans;

class kecamatanController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.kecamatan',['kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {
    	$kecamatan = new kecamatans;
    	$kecamatan->nama = $request->nama;
    	$kecamatan->save();
    	return redirect()->action('kecamatanController@tampil');
    }

    public function ubah(Request $request)
    {
    	$kecamatan = kecamatans::find($request->id);
    	$kecamatan->nama = $request->nama;
    	$kecamatan->save();
    	return redirect()->action('kecamatanController@tampil');
    }

    public function hapus(Request $request)
    {
    	$kecamatan = kecamatans::find($request->id);
    	$kecamatan->delete();
    	return redirect()->action('kecamatanController@tampil');
    }
}
