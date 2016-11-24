<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alirans extends Model
{
    public function kecamatan()
    {
    	return $this->belongsTo('App\kecamatans','id_kecamatan');
    }
}
