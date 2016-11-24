<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class urus_kecamatans extends Model
{
    public function kecamatan()
    {
    	return $this->belongsTo('App\kecamatans','id_kecamatan');
    }
}
