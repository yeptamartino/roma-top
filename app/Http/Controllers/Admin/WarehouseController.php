<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Helpers\ImageUploader;
use Flash;
class WarehouseController extends Controller
{

  public function index(Request $request)
  {
    $valsearch = preg_replace('/[^A-Za-z0-9 ]/', '', $request->input('search'));

    if ($valsearch == "" || $valsearch == "0") {

      $q_search = "";
    } else {
      $q_search = " AND name like '%" . $valsearch . "%'";
    }
    $warehouses = Warehouse::whereRaw('1 ' . $q_search)
      ->orderBy('name', 'asc')
      ->paginate(10);
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
    $warehouse->delete();
    Flash::error('Data gudang berhasil di hapus.');
    return redirect()->route('admin.warehouse');
  }
}
