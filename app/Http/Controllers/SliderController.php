<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

    	$sliders = Slider::all();

    	return view('slider', ['sliders' => $sliders]);
    }

    public function store(Request $request){

    	if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            Image::make($foto)->resize(1920, 980)->save('img/sliders/' . $filename);
        } else {
            $filename = 'default-slider.jpg';
        }

        $slider = new Slider;

        $slider->foto = $filename;
        $slider->judul = $request->judul;
        $slider->deskripsi = $request->deskripsi;

        $slider->save();

    	return redirect()->action('SliderController@index');
    }

    public function update(Request $request){
        
    	if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            Image::make($foto)->resize(1920, 980)->save('img/sliders/' . $filename);
        } else {
            $oldfilename = Slider::where('id', $request->id)->first();
            $filename = $oldfilename->foto;
        }

        $slider = Slider::find($request->id);

    	$slider->foto = $filename;
        $slider->judul = $request->judul;
        $slider->deskripsi = $request->deskripsi;

        $slider->save();

    	return redirect()->action('SliderController@index');
    }

    public function destroy(Request $request){

    	Slider::find($request->id)->delete();

    	return redirect()->action('SliderController@index');
    }
}
