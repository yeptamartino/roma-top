<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Stock;
use App\Models\Warehouse;
use App\Models\Constants;
use App\Exports\TransactionsExport;
use App\Helpers\ExcelHelper;
use Maatwebsite\Excel\Facades\Excel;
use Flash;

class SalesController extends Controller
{
  public function index(Request $request, ExcelHelper $excelHelper) {
    $keyword = $request->get('keyword');
    $tgl_awal = $request->get('tgl_awal');
    $tgl_akhir = $request->get('tgl_akhir');
    $action = $request->get('action');
    
    $transactions = Transaction::orderBy('created_at', 'desc');

    if ($tgl_awal &&  $tgl_akhir){
      $transactions = $transactions->whereBetween('created_at', [$tgl_awal, $tgl_akhir]);
    }
    
    if($keyword) {
      $transactions =  $transactions->where(function ($query) use ($keyword){
        $query->orWhere('id','LIKE',"%$keyword%");
      });
    }

    if($action === 'Excel' || $action === 'Pdf') {
      if(!$tgl_awal || !$tgl_akhir) {
        return redirect()->back()->with('error', Constants::$MESSAGE_EXPORT_EXCEL_PDF_NO_DATES);
      }
      return Excel::download(
        new TransactionsExport($transactions->get()),
        $excelHelper->generateExcelFileName(
          'transactions',
          $keyword,
          $tgl_awal,
          $tgl_akhir,
          $action === 'Excel' ? 'xlsx' : 'pdf'
        )
      );
    }
    
    $transactions = $transactions->paginate(Constants::$DEFAULT_PAGINATION_COUNT);

    return view('admin.sales.index', compact('transactions'));
  }

  public function detail($id) {
    $transaction = Transaction::findOrFail($id);
    return view('admin.sales.detail', compact('transaction'));
  }

  public function create() {
    $warehouses = Warehouse::get();
    $catalogs = Catalog::with('stocks')->get();
    $categories = Category::get();
    $discounts = Discount::get();
    $customers = Customer::get();
    $payment_methods = PaymentMethod::get();

    return view(
      'admin.sales.create',
      compact(
        'warehouses',
        'catalogs',
        'categories',
        'discounts',
        'customers',
        'payment_methods',
      ),
    );
  }

  public function createTransaction(Request $request) {
    $data = $request->all();
    $transaction = new Transaction([
      'payment_method' => $data['payment_method'] ?? 'CASH',
      'total_paid' => $data['total_paid'],
      'total_ongkir' => $data['total_ongkir'],
      'discount_id' => $data['discount_id'],
      'customer_id' => $data['customer_id'],
      'note' => $data['note'] ?? '',
      'status' => Constants::$TRANSACTION_STATUS_DELIVERED,
    ]);

    $transaction->save();

    $transaction_items = [];

    $carts = json_decode($data['carts']);

    foreach($carts as $cart) {
      $stock = Stock::where('catalog_id', $cart->id)->where('warehouse_id', $cart->warehouse->id)->first();

      if(!$stock) {
        return redirect()->back()->with('error', 'Stok untuk ' . $cart->name . ' tidak ditemukan di gudang ' . $cart->warehouse->name);
      }

      if($stock->total <= 0) {
        return redirect()->back()->with('error', 'Stok untuk ' . $cart->name . ' di gudang ' . $cart->warehouse->name . ' telah habis.');
      }

      $stock->total -= $cart->quantity;
      $stock->save();

      array_push($transaction_items, new TransactionItem([
        'name' => $cart->name,
        'quantity' => $cart->quantity,
        'capital_price' => $cart->capital_price,
        'selling_price' => $cart->selling_price,
        'warehouse' => $cart->warehouse->name,
      ]));
    }

    $transaction->transaction_items()->saveMany($transaction_items);
    

    return redirect()->back()->with('success', 'Transaksi berhasil dibuat, lihat di daftar transaksi.');
  }
}
