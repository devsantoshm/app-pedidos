<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	//Asignación masiva de atributos
	protected $fillable = ['name', 'description'];
	
	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
