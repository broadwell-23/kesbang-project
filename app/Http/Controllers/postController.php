<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\posts;
use App\categorys;
use App\postcategorys;

class postController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dataNew()
    {
            $judul = "Tambah";
            $id = null;
            return view('postingan.new-edit', ['judul'=>$judul,'id'=>$id]);
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
    		$SEOtitle = strip_tags(substr($request->judul, 0,50));
    	} else {
    		$SEOtitle = $request->SEOtitle;
    	}

    	$post->SEOtitle = $SEOtitle;

    	if ($request->SEOdesc==null) {
    		$SEOdesc = rtrim(strip_tags(substr($request->deskripsi, 0,160)), "\r\n");
    	} else {
    		$SEOdesc = $request->SEOdesc;
    	}

        $post->SEOtitle = $SEOtitle;
    	$post->SEOdesc = $SEOdesc;
    	$post->foto = $request->foto;
    	$post->author = $request->author;
    	$post->status = $status;
    	$post->save();
        $category = $request->category;
        for($i=0;$i<count($category);$i++) {
            $postcategorys = new postcategorys;
            $postcategorys->id_posts = $post->id;
            $postcategorys->id_categorys = $category[$i];
            $postcategorys->save();
        }
        return redirect()->action('postController@tampil');
    }

    public function tampil()
    {
        $posts = posts::with('postcategory.category')->join('users', 'posts.author','=','users.id')->select('posts.*','users.name')->get();
        return view('postingan.artikel',['posts'=>$posts]);
    }

    public function hapus(Request $request)
    {
        $posts = posts::find($request->id);
        $posts->delete();
        return redirect()->action('postController@tampil');
    }

    public function editNew($id)
    {
            $posts = posts::with('postcategory.category')->find($id);
            $judul="Edit";
            return view('postingan.new-edit', ['posts'=>$posts, 'judul'=>$judul , 'id'=>$id]);
    }

    public function ubah(Request $request)
    {
        $status;
        if (isset($_POST['draft'])) {
            $status = 0;
        } else {
            $status = 1;
        }

        $post = posts::find($request->id);
        $post->judul = $request->judul;
        $post->deskripsi = $request->deskripsi;

        if ($request->SEOtitle==null) {
            $SEOtitle = strip_tags(substr($request->judul, 0,50));
        } else {
            $SEOtitle = $request->SEOtitle;
        }

        $post->SEOtitle = $SEOtitle;

        if ($request->SEOdesc==null) {
            $SEOdesc = rtrim(strip_tags(substr($request->deskripsi, 0,160)), "\r\n");
        } else {
            $SEOdesc = $request->SEOdesc;
        }

        $post->SEOtitle = $SEOtitle;
        $post->SEOdesc = $SEOdesc;
        $post->foto = $request->foto;
        $post->author = $request->author;
        $post->status = $status;
        $post->save();

        $postcategory = postcategorys::where('id_posts',$post->id);
        $postcategory->delete();

        $category = $request->category;
        for($i=0;$i<count($category);$i++) {
            $postcategorys = new postcategorys;
            $postcategorys->id_posts = $post->id;
            $postcategorys->id_categorys = $category[$i];
            $postcategorys->save();
        }
        return redirect()->action('postController@tampil');
    }
}
