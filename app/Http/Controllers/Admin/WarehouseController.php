<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Constants;
use App\Helpers\ImageUploader;
use Flash;
class WarehouseController extends Controller
{

  public function index(Request $request)
  {
    $warehouses = Warehouse::orderBy('updated_at', 'desc')->limit(1000)->get();
    return view('admin.warehouse.index', compact('warehouses'));
  }

  public function create()
  {
    return view('admin.warehouse.create');
  }

  public function store(Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Warehouse::$validation);
    $warehouse = new Warehouse([
      'name'       => $request->input('name'),
      'address' => $request->input('address'),
    ]);
    $warehouse->thumbnail = $imageUploader->saveImage($request, 'thumbnail');

    $warehouse->save();
    Flash::success('Data gudang berhasil di tambahkan.');
    return redirect()->route('admin.warehouse');
  }

  public function edit($id)
  {
    $warehouse = Warehouse::findOrFail($id);
    return view('admin.warehouse.edit', compact('warehouse'));
  }

  public function update($id, Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Warehouse::$validation);
    $warehouse = Warehouse::findOrFail($id);

    $warehouse->name        = $request->input('name');
    $warehouse->address  = $request->input('address');

    if($request->file('thumbnail')) {
        $warehouse->thumbnail    = $imageUploader->saveImage($request, 'thumbnail');
      }
  
    $warehouse->save();
    Flash::success('Data gudang berhasil di ubah.');

    return redirect()->route('admin.warehouse');
  }

  public function delete($id) 
  {
    $warehouse = Warehouse::findOrFail($id);
    if($warehouse->stock) {
      if(count($warehouse->stock) > 0) {
        Flash::warning('Gudang tidak bisa di hapus, karena stock masih ada.');      
        return redirect()->back();
      }
    }
    $warehouse->delete();
    Flash::success('Data gudang berhasil di hapus.');
    return redirect()->route('admin.warehouse');
  }
}
