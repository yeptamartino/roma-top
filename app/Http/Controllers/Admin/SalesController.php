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
use Flash;

class SalesController extends Controller
{
  public function index() {
    $catalogs = Catalog::get();
    $categories = Category::get();
    $discounts = Discount::get();
    $customers = Customer::get();
    $payment_methods = PaymentMethod::get();

    return view(
      'admin.sales.index',
      compact(
        'catalogs',
        'categories',
        'discounts',
        'customers',
        'payment_methods',
      ),
    );
  }
}
