<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;
use Image;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

    	$galleries = Gallery::all();

    	return view('gallery', ['galleries' => $galleries]);
    }

    public function store(Request $request){

    	if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            Image::make($foto)->resize(447, 447)->save('img/galleries/' . $filename);
        } else {
            $filename = 'default-gallery.jpg';
        }

        $gallery = new Gallery;

        $gallery->foto = $filename;
        $gallery->judul = $request->judul;
        $gallery->deskripsi = $request->deskripsi;

        $gallery->save();

    	return redirect()->action('GalleryController@index');
    }

    public function update(Request $request){
        
    	if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            Image::make($foto)->resize(447, 447)->save('img/galleries/' . $filename);
        } else {
            $oldfilename = Gallery::where('id', $request->id)->first();
            $filename = $oldfilename->foto;
        }

        $gallery = Gallery::find($request->id);

    	$gallery->foto = $filename;
        $gallery->judul = $request->judul;
        $gallery->deskripsi = $request->deskripsi;

        $gallery->save();

    	return redirect()->action('GalleryController@index');
    }

    public function destroy(Request $request){

    	Gallery::find($request->id)->delete();

    	return redirect()->action('GalleryController@index');
    }
}
