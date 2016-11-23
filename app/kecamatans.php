<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kecamatans extends Model
{
    public function agama()
    {
    	return $this->hasOne('App\agamas','id_kecamatan','id');
    }
}
