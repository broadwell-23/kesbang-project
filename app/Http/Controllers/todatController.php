<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kecamatans;
use App\todats;

class todatController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$todats = todats::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.todat',['todats'=>$todats,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {

            $todat = new todats;
            $todat->id_kecamatan = $request->id_kecamatan;
            $todat->nama = $request->nama;
            $todat->no_hp = $request->no_hp;
            $todat->alamat = $request->alamat;
            $todat->save();
            return redirect()->action('todatController@tampil');
    }

    public function ubah(Request $request)
    {
    	$todat = todats::find($request->id);
    	$todat->id_kecamatan = $request->id_kecamatan;
        $todat->nama = $request->nama;
        $todat->no_hp = $request->no_hp;
        $todat->alamat = $request->alamat;
        $todat->save();
        return redirect()->action('todatController@tampil');
    }

    public function hapus(Request $request)
    {
    	$todat = todats::find($request->id);
    	$todat->delete();
        return redirect()->action('todatController@tampil');
    }
}
