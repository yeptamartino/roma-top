<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Constants;
use App\Helpers\ImageUploader;
use Flash;
class CatalogController extends Controller
{

  public function index(Request $request)
  {
    // $search = $request->get('search');
    // $category = $request->get('category_id');
    
    // $catalogs = Catalog::orderBy('created_at', 'desc');
    // if($search) {
    //   $catalogs =  $catalogs->where(function ($query) use ($search){
    //     $query->orWhere('name','LIKE',"%$search%");
    //   });
    // }

    // $catalogs = $catalogs->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
    // $category = Category::all();
  $search = $request->get('search');
  $category = $request->get('category');
  $action = $request->get('action');
  
  $catalogs = Catalog::orderBy('updated_at','desc');
  if($category){
    $catalogs->where('category_id', $category);
  }
  if($search) {
    $catalogs->where(function ($query) use ($search) {
      $query->orWhere('name','LIKE',"%$search%");
    }); 
  }
  $category = Category::all();
  $catalogs = $catalogs->paginate(Constants::$DEFAULT_PAGINATION_COUNT);

    return view('admin.catalog.index', compact('catalogs','category'));
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
