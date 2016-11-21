<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class categorys extends Model
{

	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function postcategorys()
    {
    	return $this->hasMany('App\postcategorys','id_categorys','id');
    }

    public function navbar()
    {
    	return $this->hasMany('App\navbars','id_categorys','id');
    }
}
