<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Constants;
use Flash;
class CategoryController extends Controller
{

  public function index(Request $request)
  {
    $categories = Category::orderBy('updated_at', 'desc')->limit(2000)->get();
    return view('admin.category.index', compact('categories'));
  }

  public function create()
  {
    return view('admin.category.create');
  }

  public function store(Request $request)
  {
    $request->validate(Category::$validation);
    $category = new Category([
      'name' => $request->input('name')
    ]);
    Flash::success('Data kategori berhasil di tambahkan.');
    $category->save();

    return redirect()->route('admin.category');
  }

  public function edit($id)
  {
    $category = Category::findOrFail($id);
    return view('admin.category.edit', compact('category'));
  }

  public function update($id, Request $request)
  { 
    $request->validate(Category::$validation);
    $category = Category::findOrFail($id);

    $category->name = $request->input('name');

    Flash::success('Data kategori berhasil di ubah.');
    $category->save();

    return redirect()->route('admin.category');
  }

  public function delete($id)
  {
    $category = Category::findOrFail($id);
    if($category->catalogs) {
      if(count($category->catalogs) > 0) {
      Flash::warning('Kategori tidak bisa di hapus, karena masih digunakan.');      
        return redirect()->back();
    }
  }

    $category->delete();
    Flash::success('Data kategori berhasil di hapus.');
    return redirect()->route('admin.category');
  }
}
