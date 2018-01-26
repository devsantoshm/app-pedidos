<?php

namespace App\Http\Controllers\Admin;

 // ya que al crear una carpeta Admin, la clase bse Controller lo busca dentro de Admin
// por lo tanto, hay que especificar donde realmente esta la clase base Controller
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::paginate(10);
    	return view('admin.products.index', compact('products'));
    }

    public function create() //muestra la vista de registro de un producto
    {
        $categories = Category::orderBy('name')->get();
    	return view('admin.products.create', compact('categories'));
    }

    //registrar un nuevo producto en la bd
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Ingresa un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Ingresa una descripción para el producto',
            'description.max' => 'La descripción solo admite hasta 200 caracteres',
            'price.required' => 'Ingresa un precio para el producto',
            'price.numeric' => 'Ingresa un precio válido',
            'price.min' => 'No se admiten valores negativos'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
  
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->save(); // INSERT en la bd

        return redirect('admin/products');
    }

    public function edit($id) //muestra el formulario edición de un producto
    {
        $categories = Category::orderBy('name')->get();
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    //registrar un nuevo producto en la bd
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Ingresa un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Ingresa una descripción para el producto',
            'description.max' => 'La descripción solo admite hasta 200 caracteres',
            'price.required' => 'Ingresa un precio para el producto',
            'price.numeric' => 'Ingresa un precio válido',
            'price.min' => 'No se admiten valores negativos'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->save(); // INSERT OR UPDATE en la bd

        return redirect('admin/products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return back(); // retorna a la página anterior
    }
}
