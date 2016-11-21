<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pages;

class pageController extends Controller
{
	public function dataNew()
	{
		$judul="Tambah";
        $id=null;
		return view('pages.new-edit',['judul'=>$judul,'id'=>$id]);
	}

    public function tambah(Request $request)
    {
    	$status;
    	if (isset($_POST['draft'])) {
    		$status = 0;
    	} else {
    		$status = 1;
    	}

    	$page = new pages;
    	$page->judul = $request->judul;
    	$page->deskripsi = $request->deskripsi;

    	if ($request->SEOtitle==null) {
    		$SEOtitle = strip_tags(substr($request->judul, 0,50));
    	} else {
    		$SEOtitle = $request->SEOtitle;
    	}  

    	$page->SEOtitle = $SEOtitle;

    	if ($request->SEOdesc==null) {
    		$SEOdesc = rtrim(strip_tags(substr($request->deskripsi, 0,160)), "\r\n");
    	} else {
    		$SEOdesc = $request->SEOdesc;
    	}

        $page->SEOtitle = $SEOtitle;
    	$page->SEOdesc = $SEOdesc;
    	$page->foto = $request->foto;
    	$page->author = $request->author;
    	$page->status = $status;
    	$page->save();
    	return redirect()->action('pageController@tampil');
    }

    public function tampil()
    {
    	$pages = pages::with('user')->get();
    	return view('pages.halaman',['pages'=>$pages]);
    }

    public function hapus(Request $request)
    {
    	$pages = pages::find($request->id);
    	$pages->delete();
    	return redirect()->action('pageController@tampil');
    }

    public function EditNew($id)
    {
    	$pages = pages::find($id);
		$judul="Edit";
    	return view('pages.new-edit',['pages'=>$pages,'judul'=>$judul,'id'=>$id]);
    }

    public function ubah(Request $request)
    {
    	$status;
    	if (isset($_POST['draft'])) {
    		$status = 0;
    	} else {
    		$status = 1;
    	}

    	$page = pages::find($request->id);
    	$page->judul = $request->judul;
    	$page->deskripsi = $request->deskripsi;

    	if ($request->SEOtitle==null) {
    		$SEOtitle = strip_tags(substr($request->judul, 0,50));
    	} else {
    		$SEOtitle = $request->SEOtitle;
    	}  

    	$page->SEOtitle = $SEOtitle;

    	if ($request->SEOdesc==null) {
    		$SEOdesc = rtrim(strip_tags(substr($request->deskripsi, 0,160)), "\r\n");
    	} else {
    		$SEOdesc = $request->SEOdesc;
    	}

        $page->SEOtitle = $SEOtitle;
    	$page->SEOdesc = $SEOdesc;
    	$page->foto = $request->foto;
    	$page->author = $request->author;
    	$page->status = $status;
    	$page->save();
    	return redirect()->action('pageController@tampil');
    }
}
