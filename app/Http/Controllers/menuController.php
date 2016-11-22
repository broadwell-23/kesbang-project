<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\navbars;
class menuController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function tampil()
    {
    	$navbars = navbars::all();
    	return view('navbar',['navbars'=>$navbars]);
    }

    public function tambah(Request $request)
    {
    	$navbars = new navbars;
    	$navbars->text = $request->text;
    	$navbars->link = $request->link;
    	if($request->parent!=null){
    		$navbars->parent = $request->parent;
    	}
    	$navbars->save();
    	return redirect()->action('menuController@tampil');
    }

    public function ubah(Request $request)
    {
    	$navbars = navbars::find($request->id);
        $navbars->text = $request->text;
        $navbars->link = $request->link;
        if($request->parent!=null){
            $navbars->parent = $request->parent;
        }
        $navbars->save();
        return redirect()->action('menuController@tampil');    }

    public function hapus(Request $request)
    {
    	$navbars = navbars::find($request->id);
    	$navbars->delete();
    	return redirect()->action('menuController@tampil');
    }
}
