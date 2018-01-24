<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function index()
    {
    	$categories = Category::orderBy('name')->paginate(10); // ordernar por el nombre de forma ascendente
    	return view('admin.categories.index', compact('categories'));
    }

    public function create() //muestra la vista de registro de un producto
    {
    	return view('admin.categories.create');
    }

    //registrar un nuevo producto en la bd
    public function store(Request $request)
    {
        $this->validate($request, Category::$rules, Category::$messages);
  
        Category::create($request->all()); //Asignación masiva de atributos

        return redirect('admin/categories');
    }

    //muestra el formulario edición de un producto
    public function edit(Category $category) //El id que recibimos se convierte en una categoria
    {
        //$category = Category::find($id); ejecuta find por detrás con el objeto category
        return view('admin.categories.edit', compact('category'));
    }

    //registrar un nuevo producto en la bd
    public function update(Request $request, Category $category) // convierte el $id en un objeto category
    {
        $this->validate($request, Category::$rules, Category::$messages);
        
        $category->update($request->all());

        return redirect('admin/categories');
    }

    public function destroy(Category $category)
    {
        //$product = Product::find($id);
        $category->delete();

        return back(); // retorna a la página anterior
    }
}
