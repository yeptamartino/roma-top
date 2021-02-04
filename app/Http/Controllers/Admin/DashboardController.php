<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Constants;
use App\Models\Transaction;
use App\Models\Customer;
use Carbon\Carbon;
use Flash;
class DashboardController extends Controller
{
    public function dashboard(Request $request){
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
      
      $transactions = Transaction::select('transactions.*', 'customers.name')
      ->join('customers', 'customers.id', '=', 'transactions.customer_id')->orderBy('created_at', 'desc');
     
      if($search) {
        $transactions =  $transactions->where(function ($query) use ($search){
          $query->orWhere('customers.name','LIKE',"%$search%");
        });
      }

      $transactions = $transactions->paginate(Constants::$DEFAULT_PAGINATION_COUNT);

      $start_of_this_month = Carbon::now()->startOfMonth();
      $end_of_this_month = Carbon::now()->endOfMonth();

      $transactions_this_month = Transaction::whereBetween('created_at', [$start_of_this_month, $end_of_this_month])->get();

      $sales_this_month = 0;
      $transactions_count_this_month = 0;
      $sold_items_count = 0;
      $total_customer = Customer::count();

      foreach($transactions_this_month as $transaction) {
        $sales_this_month += $transaction->total_price();
        $transactions_count_this_month += 1;
        $sold_items_count += $transaction->transaction_items->sum('quantity');
      }

      return view(
        'admin.dashboard',
          compact(
          'sales_this_month',
          'transactions_count_this_month',
          'sold_items_count',
          'total_customer',
          'transactions',
          'category',
          'catalogs',
        ));
    }
   
}
