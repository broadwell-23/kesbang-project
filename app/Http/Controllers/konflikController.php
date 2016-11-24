<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\konfliks;
use App\kecamatans;

class konflikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$konfliks = konfliks::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.konflik',['konfliks'=>$konfliks,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {

        $konflik = new konfliks;
        $konflik->id_kecamatan = $request->id_kecamatan;
        $konflik->potensi = $request->potensi;
        $konflik->keterangan = $request->keterangan;
        $konflik->tanggal = $request->tanggal;
        $konflik->save();
        return redirect()->action('konflikController@tampil');
    }

    public function ubah(Request $request)
    {
    	$konflik = konfliks::find($request->id);
    	$konflik->id_kecamatan = $request->id_kecamatan;
        $konflik->potensi = $request->potensi;
        $konflik->keterangan = $request->keterangan;
        $konflik->tanggal = $request->tanggal;
        $konflik->save();
        return redirect()->action('konflikController@tampil');
    }

    public function hapus(Request $request)
    {
    	$konflik = konfliks::find($request->id);
    	$konflik->delete();
        return redirect()->action('konflikController@tampil');
    }
}
