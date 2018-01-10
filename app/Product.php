<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	 //Conocoer la categoria de un producto determinado
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
   
    public function images()
    {
    	return $this->hasMany(ProductImage::class);
    }
}
