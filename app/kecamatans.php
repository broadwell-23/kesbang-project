<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kecamatans extends Model
{
    public function agama()
    {
    	return $this->hasOne('App\agamas','id_kecamatan','id');
    }

    public function etnis()
    {
        return $this->hasOne('App\etnis','id_kecamatan','id');
    }


    public function aliran()
    {
    	return $this->hasMany('App\alirans','id_kecamatan','id');
    }

    public function forum()
    {
    	return $this->hasMany('App\forums','id_kecamatan','id');
    }

    public function konflik()
    {
        return $this->hasMany('App\forums','id_kecamatan','id');
    }

    public function asing()
    {
        return $this->hasMany('App\asings','id_kecamatan','id');
    }

    public function tomas()
    {
        return $this->hasMany('App\tomas','id_kecamatan','id');
    }

    public function todats()
    {
        return $this->hasMany('App\todats','id_kecamatan','id');
    }

    public function togas()
    {
        return $this->hasMany('App\togats','id_kecamatan','id');
    }

    public function pengurus()
    {
        return $this->hasMany('App\urus_kecamatans','id_kecamatan','id');
    }
}
