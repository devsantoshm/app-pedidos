<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use File;
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
        $moved = $file->move($path, $fileName);

        // Crear un registro en la tabla product_images
        if($moved){
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            //$productImage->featured = false;
            $productImage->product_id = $id;
            $productImage->save(); // insert
        }

        return back();
    }

    public function destroy(Request $request)
    {
        // Eliminar el archivo
        $productImage = ProductImage::find($request->image_id); //$request->input('image_id')
        if (substr($productImage->image, 0, 4) === "http") {
            $deleted = true;
        } else {
            $fullPath = public_path() . '/images/products/' . $productImage->image;
            $deleted = File::delete($fullPath);
        }

        // eliminar la imágen de la bd
        if ($deleted) {
            $productImage->delete();
        }
    	
        return back();
    }
}
