<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index($id)
    {
    	$product = Product::find($id);
    	$images = $product->images;
    	return view('admin.products.images.index', compact('product', 'images'));
    }

    public function store(Request $request, $id)
    {
    	// Guardar la img en nuestro proyecto
        $file = $request->file('photo');
        $path = public_path() . '/images/products';
        $fileName = uniqid() . $file->getClientOriginalName(); //ára evitar subir imagenes con el mismo nombre
        $file->move($path, $fileName);

        // Crear un registro en la tabla product_images
        $productImage = new ProductImage();
        $productImage->image = $fileName;
        //$productImage->featured = false;
        $productImage->product_id = $id;
        $productImage->save(); // insert

        return back();
    }

    public function destroy()
    {
    	
    }
}
