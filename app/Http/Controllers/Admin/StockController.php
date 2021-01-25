<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Warehouse;
use App\Models\Catalog;

class StockController extends Controller
{

  public function index(Request $request)
  {
    $valsearch = preg_replace('/[^A-Za-z0-9 ]/', '', $request->input('search'));

    if ($valsearch == "" || $valsearch == "0") {

      $q_search = "";
    } else {
      $q_search = " AND catalog_id like '%" . $valsearch . "%'";
    }
    $stocks = Stock::whereRaw('1 ' . $q_search)
      ->orderBy('created_at', 'desc')
      ->paginate(10);
    return view('admin.stock.index', compact('stocks'));
  }

  public function create()
  {
    $catalog = Catalog::all();
    $warehouse = Warehouse::all();
    return view('admin.stock.create', compact('catalog','warehouse'));
  }

  public function store(Request $request)
  {
    $request->validate(Stock::$validation);
    $stock = new Stock([
      'catalog_id' => $request->input('catalog_id'),
      'warehouse_id'=> $request->input('warehouse_id'),
      'total' => $request->input('total'),
    ]);

    $stock->save();

    return redirect()->route('admin.stock');
  }

  public function edit($id)
  {
    $stock = Stock::findOrFail($id);
    $catalog = Catalog::all();
    $warehouse = Warehouse::all();
    return view('admin.stock.edit', compact('stock', 'catalog','warehouse'));
  }

  public function update($id, Request $request)
  {
    $stock = Stock::findOrFail($id);

    $stock->catalog_id   = $request->input('catalog_id');
    $stock->warehouse_id = $request->input('warehouse_id');
    $stock->total  = $request->input('total');

    $stock->save();

    return redirect()->route('admin.stock');
  }

  public function delete($id)
  {
    $stock = Stock::findOrFail($id);
    $stock->delete();
    return redirect()->route('admin.stock');
  }
}
