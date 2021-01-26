<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
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
use App\Models\Constants;
use Flash;
use Carbon\Carbon;

class ReportController extends Controller
{
  public function sales(Request $request) {
    $tgl_awal = $request->get('tgl_awal');
    $tgl_akhir = $request->get('tgl_akhir');
    $default_tgl_awal = Carbon::now()->startOfMonth();
    $default_tgl_akhir = Carbon::now()->endOfMonth();
    
    $transactions = Transaction::orderBy('created_at', 'desc');

    if ($tgl_awal &&  $tgl_akhir){
      $transactions = $transactions->whereBetween('created_at', [$tgl_awal, $tgl_akhir]);
    } else {
      $transactions = $transactions->whereBetween('created_at', [$default_tgl_awal, $default_tgl_akhir]);
    }    
  
    $laba_kotor = 0;
    $laba_bersih = 0;
    $total_modal = 0;
    $total_diskon = 0;
    $total_transaksi = 0;    
    
    $transactions_result = $transactions->get();   
    $transactions_group_by_date = $transactions->groupBy();

    $transaction_date_values = [];
    $transaction_date_labels = [];

    foreach($transactions_group_by_date->get() as $transaction) {
      array_push($transaction_date_labels, $transaction->created_at->format('Y-m-d'));
      array_push($transaction_date_values, $transaction->total_price());
    }

    foreach($transactions_result as $transaction) {
      $laba_kotor += $transaction->total_selling_price();
      $total_modal += $transaction->total_capital_price();
      $total_diskon += $transaction->total_discount();
      $total_transaksi += $transaction->total_price();
    }

    $laba_bersih = $laba_kotor - $total_modal;

    return view('admin.report.sales', compact(
      'default_tgl_awal',
      'default_tgl_akhir',
      'laba_kotor',
      'laba_bersih',
      'total_diskon',
      'total_transaksi',
      'transactions_group_by_date',
      'transaction_date_labels',
      'transaction_date_values'
    ));
  }
}
