<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class posts extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function postcategory()
    {
    	return $this->hasMany('App\postcategorys','id_posts','id');
    }

    public function comment()
    {
    	return $this->hasMany('App\comments','id_posts');
    }
}
