<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class urus_forums extends Model
{
    public function forum()
    {
    	return $this->belongsTo('App\forums','id_forum');
    }
}
