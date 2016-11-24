<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\About;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

    	$about = About::where('id', '1')->first();

    	return view('about', ['about' => $about]);
    }

    public function update(Request $request){

        $about = About::find($request->id);

    	$about->judul = $request->judul;
        $about->isi = $request->isi;

        $about->save();

    	return redirect()->action('AboutController@index');
    }
}
