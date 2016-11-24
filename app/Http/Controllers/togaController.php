<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\togas;
use App\kecamatans;


class togaController extends Controller
{
    public function tampil()
    {
    	$togas = togas::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.toga',['togas'=>$togas,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {

            $toga = new togas;
            $toga->id_kecamatan = $request->id_kecamatan;
            $toga->nama = $request->nama;
            $toga->no_hp = $request->no_hp;
            $toga->alamat = $request->alamat;
            $toga->save();
            return redirect()->action('togaController@tampil');
    }

    public function ubah(Request $request)
    {
    	$toga = togas::find($request->id);
    	$toga->id_kecamatan = $request->id_kecamatan;
        $toga->nama = $request->nama;
        $toga->no_hp = $request->no_hp;
        $toga->alamat = $request->alamat;
        $toga->save();
        return redirect()->action('togaController@tampil');
    }

    public function hapus(Request $request)
    {
    	$toga = togas::find($request->id);
    	$toga->delete();
        return redirect()->action('togaController@tampil');
    }
}
