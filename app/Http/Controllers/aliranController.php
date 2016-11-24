<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alirans;
use App\kecamatans;

class aliranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$alirans = alirans::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.aliransesat',['alirans'=>$alirans,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {

            $aliran = new alirans;
            $aliran->id_kecamatan = $request->id_kecamatan;
            $aliran->nama = $request->nama;
            $aliran->jumlah = $request->jumlah;
            $aliran->save();
            return redirect()->action('aliranController@tampil');
    }

    public function ubah(Request $request)
    {
    	$aliran = alirans::find($request->id);
    	$aliran->id_kecamatan = $request->id_kecamatan;
        $aliran->nama = $request->nama;
        $aliran->jumlah = $request->jumlah;
        $aliran->save();
        return redirect()->action('aliranController@tampil');
    }

    public function hapus(Request $request)
    {
    	$aliran = alirans::find($request->id);
    	$aliran->delete();
        return redirect()->action('aliranController@tampil');
    }
}
