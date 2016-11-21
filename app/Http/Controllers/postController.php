<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\posts;
use App\categorys;

class postController extends Controller
{

    public function dataNew()
    {
            $categorys = categorys::all();
            $judul = "Tambah";
            return view('postingan.new-edit', ['categorys'=>$categorys, 'judul'=>$judul]);
    }

    public function editNew($id)
    {
            $categorys = categorys::all();
            $posts = posts::with('categorys')->find($id);
            $judul = "Edit";

            return view('postingan.new-edit', ['categorys'=>$categorys,'posts'=>$posts, 'judul'=>$judul ]);
    }

    public function tambah(Request $request)
    {	
    	$status;
    	if (isset($_POST['draft'])) {
    		$status = 0;
    	} else {
    		$status = 1;
    	}

    	$post = new posts;
    	$post->judul = $request->judul;
    	$post->deskripsi = $request->deskripsi;

    	if ($request->SEOtitle==null) {
    		$SEOtitle = substr($request->judul, 0,50);
    	} else {
    		$SEOtitle = $request->SEOtitle;
    	}

    	$post->SEOtitle = $SEOtitle;

    	if ($request->SEOdesc==null) {
    		$SEOdesc = substr($request->deskripsi, 0,160);
    	} else {
    		$SEOdesc = $request->SEOdesc;
    	}

    	$post->SEOdesc = $SEOdesc;
    	$post->foto = $request->foto;
        // $post->id_categorys = $request->category;
        foreach ($request->id_category as $category) {
            echo $category.",";
        }
    	$post->author = $request->author;
    	$post->status = $status;
    	// $post->save();
    }
}
