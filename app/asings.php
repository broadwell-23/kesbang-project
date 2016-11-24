<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asings extends Model
{
    public function kecamatan()
    {
    	return $this->belongsTo('App\kecamatans','id_kecamatan');
    }
}
