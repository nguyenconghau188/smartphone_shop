<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    public function product()
    {
    	return $this->hasMany('App\Product', 'id_type', 'id');
    }
}
