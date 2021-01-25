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
use App\Models\Constants;
use Flash;

class SalesController extends Controller
{
  public function index() {
    $transactions = Transaction::get();

    return view('admin.sales.index', compact('transactions'));
  }

  public function detail($id) {
    $transaction = Transaction::findOrFail($id);
    return view('admin.sales.detail', compact('transaction'));
  }

  public function create() {
    $catalogs = Catalog::get();
    $categories = Category::get();
    $discounts = Discount::get();
    $customers = Customer::get();
    $payment_methods = PaymentMethod::get();

    return view(
      'admin.sales.create',
      compact(
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
      array_push($transaction_items, new TransactionItem([
        'name' => $cart->name,
        'quantity' => $cart->quantity,
        'capital_price' => $cart->capital_price,
        'selling_price' => $cart->selling_price,
      ]));
    }

    $transaction->transaction_items()->saveMany($transaction_items);

    return redirect()->back();
  }
}
