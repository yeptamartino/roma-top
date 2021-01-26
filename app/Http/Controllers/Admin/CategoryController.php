<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Flash;
class CategoryController extends Controller
{

  public function index(Request $request)
  {
    $valsearch = preg_replace('/[^A-Za-z0-9 ]/', '', $request->input('search'));

    if ($valsearch == "" || $valsearch == "0") {
      $q_search = "";
    } else {
      $q_search = " AND name like '%" . $valsearch . "%'";
    }
    $categories = Category::whereRaw('1 ' . $q_search)
      ->orderBy('name', 'asc')
      ->paginate(10);
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
    $category = Category::findOrFail($id);

    $category->name = $request->input('name');

    Flash::success('Data kategori berhasil di ubah.');
    $category->save();

    return redirect()->route('admin.category');
  }

  public function delete($id)
  {
    $category = Category::findOrFail($id);
    $category->delete();
    Flash::error('Data kategori berhasil di hapus.');
    return redirect()->route('admin.category');
  }
}
