<?php

use App\Category;
use App\Product;
use App\ProductImage;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*factory(Category::Class, 5)->create();
        factory(Product::Class, 60)->create();
        factory(ProductImage::Class, 120)->create(); //un producto puede tener varias imagenes*/
        $categories = factory(Category::class, 5)->create();
        $categories->each(function($cat){
        	$products = factory(Product::class, 20)->make(); // splp crea objetos, pero no almacena en la BD
        	$cat->products()->saveMany($products); // guarda en la BD la coleccion de objetos
        	
        	$products->each(function ($pro){
        		$images = factory(ProductImage::class, 5)->make();
        		$pro->images()->saveMany($images);
        	});
        });
    }
}
