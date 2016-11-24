<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kecamatans;
use App\urus_kecamatans;
use URL;

class kecamatanController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampilPengurus($id)
    {   
        $nama_kecamatan = kecamatans::find($id);
        $penguruss = urus_kecamatans::with('kecamatan')->where('id_kecamatan',$id)->get();
        return view('kecamatan.pengurus-kecamatan',['penguruss'=>$penguruss,'nama_kecamatan'=>$nama_kecamatan->nama,'id'=>$id]);
    }

    public function tambahPengurus(Request $request)
    {
        $pengurus = new urus_kecamatans;
        $pengurus->nama = $request->nama;
        $pengurus->id_kecamatan = $request->id_kecamatan;
        $pengurus->nama = $request->nama;
        $pengurus->jabatan = $request->jabatan;
        $pengurus->nip = $request->nip;
        $pengurus->foto = $request->foto;
        $pengurus->alamat = $request->alamat;
        $pengurus->no_hp = $request->no_hp;
        $pengurus->save();
        $url = URL::previous();
        return redirect($url); 
    }

    public function ubahPengurus(Request $request)
    {
        $pengurus = urus_kecamatans::find($request->id);
        $pengurus->nama = $request->nama;
        $pengurus->id_kecamatan = $request->id_kecamatan;
        $pengurus->nama = $request->nama;
        $pengurus->jabatan = $request->jabatan;
        $pengurus->nip = $request->nip;
        $pengurus->foto = $request->foto;
        $pengurus->alamat = $request->alamat;
        $pengurus->no_hp = $request->no_hp;
        $pengurus->save();
        $url = URL::previous();
        return redirect($url); 
    }

    public function hapusPengurus(Request $request)
    {
        $pengurus = urus_kecamatans::find($request->id);
        $pengurus->delete();
        $url = URL::previous();
        return redirect($url); 
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
