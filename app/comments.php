<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    public function page()
    {
    	return $this->belongsTo('App\pages','id_pages');
    }

    public function post()
    {
    	return $this->belongsTo('App\posts','id_posts');
    }
}
