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

    //accesor para la imagen destacada
    public function getFeaturedImageUrlAttribute()
    {
    	$featuredImage = $this->images()->where('featured', true)->first();
    	if (!$featuredImage) {
    		$featuredImage = $this->images()->first();
    	}

    	if ($featuredImage) {
    		return $featuredImage->url; // url un atributo calculado, devolver url de la imagen asociada a traés del accesor getUrlAttribute() del modelo ProductImage
    	}

    	return '/images/products/default.png'; // si no encuentra ninguna imágen
    }

    public function getCategoryNameAttribute()
    {
        if($this->category)
            return $this->category->name;

        return 'General';
    }
}
