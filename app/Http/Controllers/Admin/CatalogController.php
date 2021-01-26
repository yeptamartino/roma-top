<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Category;
use App\Helpers\ImageUploader;
use Flash;
class CatalogController extends Controller
{

  public function index(Request $request)
  {
    $valsearch = preg_replace('/[^A-Za-z0-9 ]/', '', $request->input('search'));

    if ($valsearch == "" || $valsearch == "0") {

      $q_search = "";
    } else {
      $q_search = " AND name like '%" . $valsearch . "%'";
    }
    $catalogs = Catalog::whereRaw('1 ' . $q_search)
      ->orderBy('created_at', 'desc')
      ->paginate(10);
    return view('admin.catalog.index', compact('catalogs'));
  }

  public function create()
  {
    $category = Category::all();
    return view('admin.catalog.create', compact('category'));
  }

  public function store(Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Catalog::$validation);
    $catalog = new Catalog([
      'category_id' => $request->input('category_id'),
      'name'        => $request->input('name'),
      'description' => $request->input('description'),
      'selling_price' => $request->input('selling_price'),
      'capital_price' => $request->input('capital_price'),
    ]);
    $catalog->thumbnail = $imageUploader->saveImage($request, 'thumbnail');
    Flash::success('Data katalog berhasil di tambahkan.');
    $catalog->save();

    return redirect()->route('admin.catalog');
  }

  public function edit($id)
  {
    $catalog = Catalog::findOrFail($id);
    $category = Category::all();
    return view('admin.catalog.edit', compact('catalog', 'category'));
  }

  public function update($id, Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Catalog::$validation);
    $catalog = Catalog::findOrFail($id);

    $catalog->category_id = $request->input('category_id');
    $catalog->name         = $request->input('name');
    $catalog->description  = $request->input('description');
    $catalog->selling_price  = $request->input('selling_price');
    $catalog->capital_price        = $request->input('capital_price');
    
    if($request->file('thumbnail')) {
      $catalog->thumbnail    = $imageUploader->saveImage($request, 'thumbnail');
    }
    Flash::success('Data katalog berhasil di ubah.');
    $catalog->save();

    return redirect()->route('admin.catalog');
  }

  public function delete($id)
  {
    $catalog = Catalog::findOrFail($id);
    $catalog->delete();
    Flash::error('Data katalog berhasil di hapus.');
    return redirect()->route('admin.catalog');
  }
}
