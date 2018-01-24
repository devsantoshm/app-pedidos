<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function index()
    {
    	$categories = Category::paginate(10);
    	return view('admin.categories.index', compact('categories'));
    }

    public function create() //muestra la vista de registro de un producto
    {
    	return view('admin.categories.create');
    }

    //registrar un nuevo producto en la bd
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para la categoría',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'description.max' => 'La descripción corta solo admite hasta 250 caracteres'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'max:250'
        ];
        $this->validate($request, $rules, $messages);
  
        Category::create($request->all()); //Asignación masiva de atributos

        return redirect('admin/categories');
    }

    public function edit($id) //muestra el formulario edición de un producto
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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
