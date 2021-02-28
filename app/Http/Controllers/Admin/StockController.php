<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Warehouse;
use App\Models\Constants;
use App\Models\Catalog;
use Flash;
class StockController extends Controller
{

  public function index(Request $request)
  {
    $stocks = Stock::with('catalog', 'warehouse')->select('warehouses.*', 'catalogs.*', 'stocks.*')
      ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
      ->join('catalogs', 'catalogs.id', '=', 'stocks.catalog_id')
      ->orderBy('stocks.created_at','desc')->limit(1000)->get();
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
    $stock = Stock::where('catalog_id', $request->input('catalog_id'))
      ->where('warehouse_id', $request->input('warehouse_id'))->first();

    if($stock) {
      return redirect()->back()->with('error', 'Satu produk hanya boleh memiliki satu instance stok di setiap warehouse.');
    }

    $stock = new Stock([
      'catalog_id' => $request->input('catalog_id'),
      'warehouse_id'=> $request->input('warehouse_id'),
      'total' => $request->input('total'),
    ]);

    $stock->save();
    Flash::success('Data stok berhasil di tambahkan.');
    return redirect()->route('admin.stock');
  }

  public function edit($id)
  {
    $stock = Stock::findOrFail($id);
    $catalog = Catalog::all();
    $warehouse = Warehouse::all();
    return view('admin.stock.edit', compact('stock', 'catalog','warehouse'));
  }

  public function mutate($id)
  {
    $stock = Stock::findOrFail($id);
    $catalog = Catalog::all();
    $warehouse = Warehouse::all();
    return view('admin.stock.mutate', compact('stock', 'catalog','warehouse'));
  }

  public function mutateAction($id, Request $request) {
    $request->validate([
      'total' => 'required|integer',
    ]);
    $total = (int) $request->input('total');
    $stock = Stock::findOrFail($id);
    
    if($stock->catalog->composites) {
      foreach($stock->catalog->composites as $composite) {
        $totalCompositeStock = $composite->item->get_total_stock_by_warehouse_id($stock->warehouse_id);

        if(($totalCompositeStock - $total) < 1) {
          return redirect()->back()->with('error', 'Stok komposisi ' . $composite->item->name . ' tidak cukup untuk membuat ' . $total . ' item.');
        }
      }
    }

    if($stock->catalog->composites) {
      foreach($stock->catalog->composites as $composite) {
        $compositeStock = $composite->item->stocks->where('warehouse_id', $stock->warehouse_id)->first();

        if($compositeStock) {
          $compositeStock->total -= $total;
          $compositeStock->save();
        }
      }
    }

    $stock->total += $total;

    $stock->save();
    Flash::success('Stock berhasil dibuat.');
    return redirect()->route('admin.stock');
  }

  public function transfer($id)
  {
    $stock = Stock::findOrFail($id);
    $catalog = Catalog::all();
    $warehouse = Warehouse::all();
  
    return view('admin.stock.transfer', compact('stock', 'catalog','warehouse'));
  }

  public function transferAction($id, Request $request)
  {
    $request->validate([
      'total' => 'required|integer|min:0',
      'warehouse_destination_id' => 'required|integer|min:0',
    ]);
    $warehouse_destination_id = $request->input('warehouse_destination_id');
    $total = (int)$request->input('total');
    $stock = Stock::findOrFail($id);

    if(($stock->total - $total) < 0) {
      return redirect()->back()->with('error', 'Jumlah stok kurang dari jumlah yang dipindahkan.');
    }

    $stock_destination = Stock::where('warehouse_id', $warehouse_destination_id)
      ->where('catalog_id', $stock->catalog_id)->first();
    
    if($stock_destination) {
      $stock_destination->total += $total;      
      $stock_destination->save();
    } else {
      $stock_destination = new Stock([
        'catalog_id' => $stock->catalog_id,
        'warehouse_id' => $warehouse_destination_id,
        'total' => $total,
      ]);
      $stock_destination->save();
    }
    
    $stock->total -= $total;

    $stock->save();
    Flash::success('Data stok berhasil di ubah.');
    return redirect()->route('admin.stock');
  }

  public function update($id, Request $request)
  {
    $request->validate(Stock::$validation);
    $stock = Stock::findOrFail($id);
    
    $stock->total  = $request->input('total');

    $stock->save();
    Flash::success('Data stok berhasil di ubah.');
    return redirect()->route('admin.stock');
  }

  public function delete($id)
  {
    $stock = Stock::findOrFail($id);
    $stock->delete();
    Flash::success('Data stok berhasil di hapus.');
    return redirect()->route('admin.stock');
  }
}
