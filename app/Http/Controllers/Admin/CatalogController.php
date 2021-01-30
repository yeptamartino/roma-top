<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Constants;
use App\Models\Composite;
use App\Helpers\ImageUploader;
use Flash;
class CatalogController extends Controller
{

  public function index(Request $request)
  {
    $search = $request->get('search');
    $catalogs = Catalog::orderBy('created_at', 'desc');
    if($search) {
      $catalogs =  $catalogs->where(function ($query) use ($search){
        $query->orWhere('name','LIKE',"%$search%");
      });
    }

    $catalogs = $catalogs->paginate(Constants::$DEFAULT_PAGINATION_COUNT);

    return view('admin.catalog.index', compact('catalogs'));
  }

  public function create()
  {
    $category = Category::all();
    $catalogs = Catalog::all();
    return view('admin.catalog.create', compact('category', 'catalogs'));
  }

  public function store(Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Catalog::$validation);
    $data = $request->all();

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

    if(isset($data['compositeEnabled'])) {
      $composites = [];

      for ($i=0; $i < count($data['composite_ids']); $i++) { 
        $amount = (float)$data['composite_amounts'][$i];
        if($amount > 0) {
          array_push($composites, [
            'composite_id' => $data['composite_ids'][$i],
            'amount' => $amount,
            'catalog_id' => $catalog->id,
          ]);
        }
      }

      Composite::insert($composites);
    }

    return redirect()->route('admin.catalog');
  }

  public function edit($id)
  {
    $catalog = Catalog::findOrFail($id);
    $category = Category::all();
    $catalogs = Catalog::all();
    return view('admin.catalog.edit', compact('catalog', 'category', 'catalogs'));
  }

  public function update($id, Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Catalog::$validation);
    $catalog = Catalog::findOrFail($id);
    $data = $request->all();

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

    $catalog->composites()->delete();

    if(isset($data['compositeEnabled'])) {
      $composites = [];

      for ($i=0; $i < count($data['composite_ids']); $i++) { 
        $amount = (float)$data['composite_amounts'][$i];
        if($amount > 0) {
          array_push($composites, [
            'composite_id' => $data['composite_ids'][$i],
            'amount' => $amount,
            'catalog_id' => $catalog->id,
          ]);
        }
      }

      Composite::insert($composites);
    }

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
