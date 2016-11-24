<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kecamatans;
use App\urus_forums;
use App\forums;
use URL;

class forumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampilPengurus($id)
    {
        $forums = forums::with('kecamatan')->where('id',$id)->first();
        // DD($forums);
        $pengurus = urus_forums::with('forum')->where('id_forum',$id)->get();
        // DD($pengurus);
        return view('kecamatan.pengurus-forum',['forums'=>$forums,'penguruss'=>$pengurus,'id'=>$id]);
    }

    public function tambahPengurus(Request $request)
    {
        $pengurus = new urus_forums;
        $pengurus->nama = $request->nama;
        $pengurus->id_forum = $request->id_forum;
        $pengurus->nama = $request->nama;
        $pengurus->jabatan = $request->jabatan;
        $pengurus->foto = $request->foto;
        $pengurus->alamat = $request->alamat;
        $pengurus->no_hp = $request->no_hp;
        $pengurus->save();
        $url = URL::previous();
        return redirect($url); 
    }

    public function ubahPengurus(Request $request)
    {
        $pengurus = urus_forums::find($request->id);
        $pengurus->nama = $request->nama;
        $pengurus->id_forum = $request->id_forum;
        $pengurus->nama = $request->nama;
        $pengurus->jabatan = $request->jabatan;
        $pengurus->foto = $request->foto;
        $pengurus->alamat = $request->alamat;
        $pengurus->no_hp = $request->no_hp;
        $pengurus->save();
        $url = URL::previous();
        return redirect($url); 
    }

    public function hapusPengurus(Request $request)
    {
        $pengurus = urus_forums::find($request->id);
        $pengurus->delete();
        $url = URL::previous();
        return redirect($url); 
    }

    public function tampil()
    {
    	$forums = forums::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.forum',['forums'=>$forums,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {

        $forum = new forums;
        $forum->id_kecamatan = $request->id_kecamatan;
        $forum->nama = $request->nama;
        $forum->tahun_daftar = $request->tahun_daftar;
        $forum->laporan = $request->laporan;
        $forum->alamat = $request->alamat;
        $forum->tipe = $request->tipe;
        $forum->save();
        return redirect()->action('forumController@tampil');
    }

    public function ubah(Request $request)
    {
    	$forum = forums::find($request->id);
    	$forum->id_kecamatan = $request->id_kecamatan;
        $forum->nama = $request->nama;
        $forum->tahun_daftar = $request->tahun_daftar;
        $forum->laporan = $request->laporan;
        $forum->alamat = $request->alamat;
        $forum->tipe = $request->tipe;
        $forum->save();
        return redirect()->action('forumController@tampil');
    }

    public function hapus(Request $request)
    {
    	$forum = forums::find($request->id);
    	$forum->delete();
        return redirect()->action('forumController@tampil');
    }
}
