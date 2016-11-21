<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class pages extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function navbar()
    {
    	return $this->hasMany('App\navbars','id_pages','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','author');
    }
}
