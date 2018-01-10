<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //A que producto le pertenece cada imagen
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
