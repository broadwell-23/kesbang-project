<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postcategorys extends Model
{
    public function post()
    {
    	return $this->belongsTo('App\postcategorys','id_posts');
    }

    public function category()
    {
    	return $this->belongsTo('App\categorys','id_categorys');
    }
}
