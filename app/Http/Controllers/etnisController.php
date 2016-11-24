<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kecamatans;
use App\etnis;
use DB;

class etnisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$etniss = etnis::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.etnis',['etniss'=>$etniss,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {
    	$id_kecamatan = etnis::where('id_kecamatan',$request->id_kecamatan)->get();
        // DD($id_kecamatan);
    	if (!$id_kecamatan->isEmpty()) {
            return redirect('/admin/etnis?success=1');
    	} else {
            $etnis = new etnis;
            $etnis->id_kecamatan = $request->id_kecamatan;
            $etnis->melayu = $request->melayu;
            $etnis->jawa = $request->jawa;
            $etnis->cina = $request->cina;
            $etnis->batak = $request->batak;
            $etnis->minang = $request->minang;
            $etnis->nias = $request->nias;
            $etnis->bugis = $request->bugis;
            $etnis->lainnya = $request->lainnya;
            $etnis->save();
            return redirect('/admin/etnis?success=0');
    	}
    }

    public function ubah(Request $request)
    {
    	DB::table('etnis')
            ->where('id_kecamatan', $request->id)
            ->update([
                'id_kecamatan' => $request->id_kecamatan,
                'melayu' => $request->melayu,
                'jawa' => $request->jawa,
                'cina' => $request->cina,
                'batak' => $request->batak,
                'minang' => $request->minang,
                'nias' => $request->nias,
                'bugis' => $request->bugis,
                'lainnya' => $request->lainnya,
                'updated_at' => \Carbon\Carbon::now()
                ]);
    	return redirect('/admin/etnis?success=0');
    }

    public function hapus(Request $request)
    {
    	DB::table('etnis')->where('id_kecamatan', '=', $request->id)->delete();
    	return redirect('/admin/etnis?success=0');
    }
}
