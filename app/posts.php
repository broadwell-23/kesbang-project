<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class posts extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function category()
    {
    	return $this->belongsTo('App\categorys','id_categorys');
    }

    public function comment()
    {
    	return $this->hasMany('App\comments','id_posts');
    }
}
