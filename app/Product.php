<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function typeProduct()
    {
    	return $this->belongsTo('App\TypeProduct', 'id_type', 'id');
    }

    public function manufactory()
    {
    	return $this->belongsTo('App\Manufactory', 'id_manufactory', 'id');
    }
}
