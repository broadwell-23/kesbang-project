<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kecamatans;
use App\tomas;

class tomasController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$tomass = tomas::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.tomas',['tomass'=>$tomass,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {

            $tomas = new tomas;
            $tomas->id_kecamatan = $request->id_kecamatan;
            $tomas->nama = $request->nama;
            $tomas->no_hp = $request->no_hp;
            $tomas->alamat = $request->alamat;
            $tomas->save();
            return redirect()->action('tomasController@tampil');
    }

    public function ubah(Request $request)
    {
    	$tomas = tomas::find($request->id);
    	$tomas->id_kecamatan = $request->id_kecamatan;
        $tomas->nama = $request->nama;
        $tomas->no_hp = $request->no_hp;
        $tomas->alamat = $request->alamat;
        $tomas->save();
        return redirect()->action('tomasController@tampil');
    }

    public function hapus(Request $request)
    {
    	$tomas = tomas::find($request->id);
    	$tomas->delete();
        return redirect()->action('tomasController@tampil');
    }
}
