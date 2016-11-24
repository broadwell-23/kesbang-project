<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class forums extends Model
{
    public function kecamatan()
    {
    	return $this->belongsTo('App\kecamatans','id_kecamatan');
    }

    public function pengurus()
    {
        return $this->hasMany('App\urus_forums','id_forum','id');
    }
}
