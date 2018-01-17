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

    //Atributo calculado - Accesor
    //$a === $b	Idéntico TRUE si $a es igual a $b, y son del mismo tipo.
    //substr(): Extraer subcadenas o partes de una cadena 
    //$resultado = substr("pruebacadenas", 2, 2); echo $resultado; // imprime "ue"
    public function getUrlAttribute()
    {
    	if (substr($this->image, 0, 4) === "http") {
    		return $this->image;
    	}

    	return '/images/products/' . $this->image;
    }
}
