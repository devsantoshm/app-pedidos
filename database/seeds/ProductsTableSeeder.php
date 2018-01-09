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
    	factory(Category::Class, 5)->create();
        factory(Product::Class, 60)->create();
        factory(ProductImage::Class, 120)->create(); //un producto puede tener varias imagenes
    }
}
