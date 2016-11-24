<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kecamatans;
use App\asings;

class asingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$asings = asings::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.asing',['asings'=>$asings,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {

            $asing = new asings;
            $asing->id_kecamatan = $request->id_kecamatan;
            $asing->nama = $request->nama;
            $asing->jk = $request->jk;
            $asing->tempat = $request->tempat;
            $asing->tl = $request->tl;
            $asing->kebangsaan = $request->kebangsaan;
            $asing->no_paspor = $request->no_paspor;
            $asing->masa_paspor = $request->masa_paspor;
            $asing->no_kitas = $request->no_kitas;
            $asing->masa_kitas = $request->masa_kitas;
            $asing->sponsor = $request->sponsor;
            $asing->keterangan = $request->keterangan;
            $asing->save();
            return redirect()->action('asingController@tampil');
    }

    public function ubah(Request $request)
    {
    	$asing = asings::find($request->id);
    	$asing->id_kecamatan = $request->id_kecamatan;
        $asing->nama = $request->nama;
        $asing->jk = $request->jk;
        $asing->tempat = $request->tempat;
        $asing->tl = $request->tl;
        $asing->kebangsaan = $request->kebangsaan;
        $asing->no_paspor = $request->no_paspor;
        $asing->masa_paspor = $request->masa_paspor;
        $asing->no_kitas = $request->no_kitas;
        $asing->masa_kitas = $request->masa_kitas;
        $asing->sponsor = $request->sponsor;
        $asing->keterangan = $request->keterangan;
        $asing->save();
        return redirect()->action('asingController@tampil');
    }

    public function hapus(Request $request)
    {
    	$asing = asings::find($request->id);
    	$asing->delete();
        return redirect()->action('asingController@tampil');
    }
}
