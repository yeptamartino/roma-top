<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Customer;
use Flash;

class SalesController extends Controller
{
  public function index() {
    $catalogs = Catalog::get();
    $categories = Category::get();
    $vouchers = [];
    $customers = Customer::get();

    return view(
      'admin.sales.index',
      compact(
        'catalogs',
        'categories',
        'vouchers',
        'customers',
      ),
    );
  }
}
