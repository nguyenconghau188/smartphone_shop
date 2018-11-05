<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufactory extends Model
{
    protected $table = 'manufactories';

    public function product()
    {
    	return $this->hasMany('App\Product', 'id_manufactory', 'id');
    }
}
