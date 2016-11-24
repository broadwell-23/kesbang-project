<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\agamas;
use App\kecamatans;
use DB;

class agamaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampil()
    {
    	$agamas = agamas::with('kecamatan')->get();
    	$kecamatans = kecamatans::all();
    	return view('kecamatan.agama',['agamas'=>$agamas,'kecamatans'=>$kecamatans]);
    }

    public function tambah(Request $request)
    {
        // DD($request);
    	$id_kecamatan = agamas::where('id_kecamatan',$request->id_kecamatan)->get();
        // DD($id_kecamatan);
    	if (!$id_kecamatan->isEmpty()) {
            return redirect('/admin/agama?success=1');
    	} else {
            $agama = new agamas;
            $agama->id_kecamatan = $request->id_kecamatan;
            $agama->islam = $request->islam;
            $agama->katolik = $request->katolik;
            $agama->kristen = $request->kristen;
            $agama->hindu = $request->hindu;
            $agama->budha = $request->budha;
            $agama->save();
            return redirect('/admin/agama?success=0');
    	}
    }

    public function ubah(Request $request)
    {
    	DB::table('agamas')
            ->where('id_kecamatan', $request->id)
            ->update([
                'id_kecamatan' => $request->id_kecamatan,
                'islam' => $request->islam,
                'katolik' => $request->katolik,
                'kristen' => $request->kristen,
                'hindu' => $request->hindu,
                'budha' => $request->budha,
                'updated_at' => \Carbon\Carbon::now()
                ]);
    	return redirect('/admin/agama?success=0');
    }

    public function hapus(Request $request)
    {
    	DB::table('agamas')->where('id_kecamatan', '=', $request->id)->delete();
    	return redirect('/admin/agama?success=0');
    }
}
