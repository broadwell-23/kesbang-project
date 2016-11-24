<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class konfliks extends Model
{
    public function kecamatan()
    {
    	return $this->belongsTo('App\kecamatans','id_kecamatan');
    }
}
