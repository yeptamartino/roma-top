<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function (){
    Route::get('home', [App\Http\Controllers\Admin\DashboardController::class,'dashboard'])->name('admin.dashboard');

    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class,'index'])->name('admin.category');
    Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class,'create'])->name('admin.category.create');
    Route::post('category.create', [App\Http\Controllers\Admin\CategoryController::class,'store'])->name('admin.category.store');
    Route::get('category.edit/{id}', [App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('admin.category.edit');
    Route::put('category.update/{id}', [App\Http\Controllers\Admin\CategoryController::class,'update'])->name('admin.category.update');
    Route::delete('category.delete/{id}', [App\Http\Controllers\Admin\CategoryController::class,'delete'])->name('admin.category.delete');

    Route::get('catalog', [App\Http\Controllers\Admin\CatalogController::class,'index'])->name('admin.catalog');
    Route::get('catalog/create', [App\Http\Controllers\Admin\CatalogController::class,'create'])->name('admin.catalog.create');
    Route::post('catalog.create', [App\Http\Controllers\Admin\CatalogController::class,'store'])->name('admin.catalog.store');
    Route::get('catalog.edit/{id}', [App\Http\Controllers\Admin\CatalogController::class,'edit'])->name('admin.catalog.edit');
    Route::put('catalog.update/{id}', [App\Http\Controllers\Admin\CatalogController::class,'update'])->name('admin.catalog.update');
    Route::delete('catalog.delete/{id}', [App\Http\Controllers\Admin\CatalogController::class,'delete'])->name('admin.catalog.delete');

    Route::get('stock', [App\Http\Controllers\Admin\StockController::class,'index'])->name('admin.stock');
    Route::get('stock/create', [App\Http\Controllers\Admin\StockController::class,'create'])->name('admin.stock.create');
    Route::post('stock.create', [App\Http\Controllers\Admin\StockController::class,'store'])->name('admin.stock.store');
    Route::get('stock.edit/{id}', [App\Http\Controllers\Admin\StockController::class,'edit'])->name('admin.stock.edit');
    Route::put('stock.update/{id}', [App\Http\Controllers\Admin\StockController::class,'update'])->name('admin.stock.update');
    Route::delete('stock.delete/{id}', [App\Http\Controllers\Admin\StockController::class,'delete'])->name('admin.stock.delete');

    Route::get('warehouse', [App\Http\Controllers\Admin\WarehouseController::class,'index'])->name('admin.warehouse');
    Route::get('warehouse/create', [App\Http\Controllers\Admin\WarehouseController::class,'create'])->name('admin.warehouse.create');
    Route::post('warehouse.create', [App\Http\Controllers\Admin\WarehouseController::class,'store'])->name('admin.warehouse.store');
    Route::get('warehouse.edit/{id}', [App\Http\Controllers\Admin\WarehouseController::class,'edit'])->name('admin.warehouse.edit');
    Route::put('warehouse.update/{id}', [App\Http\Controllers\Admin\WarehouseController::class,'update'])->name('admin.warehouse.update');
    Route::delete('warehouse.delete/{id}', [App\Http\Controllers\Admin\WarehouseController::class,'delete'])->name('admin.warehouse.delete');

    Route::get('admin', [App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin.admin');
    Route::get('admin/create', [App\Http\Controllers\Admin\AdminController::class,'create'])->name('admin.admin.create');
    Route::post('admin.create', [App\Http\Controllers\Admin\AdminController::class,'store'])->name('admin.admin.store');
    Route::get('admin.edit/{id}', [App\Http\Controllers\Admin\AdminController::class,'edit'])->name('admin.admin.edit');
    Route::put('admin.update/{id}', [App\Http\Controllers\Admin\AdminController::class,'update'])->name('admin.admin.update');
    Route::delete('admin.delete/{id}', [App\Http\Controllers\Admin\AdminController::class,'delete'])->name('admin.admin.delete');
    
    Route::get('customer', [App\Http\Controllers\Admin\CustomerController::class,'index'])->name('admin.customer');
    Route::get('customer/create', [App\Http\Controllers\Admin\CustomerController::class,'create'])->name('admin.customer.create');
    Route::post('customer.create', [App\Http\Controllers\Admin\CustomerController::class,'store'])->name('admin.customer.store');
    Route::get('customer.edit/{id}', [App\Http\Controllers\Admin\CustomerController::class,'edit'])->name('admin.customer.edit');
    Route::put('customer.update/{id}', [App\Http\Controllers\Admin\CustomerController::class,'update'])->name('admin.customer.update');
    Route::delete('customer.delete/{id}', [App\Http\Controllers\Admin\CustomerController::class,'delete'])->name('admin.customer.delete');

    Route::get('payment', [App\Http\Controllers\Admin\PaymentMethodController::class,'index'])->name('admin.payment');
    Route::get('payment/create', [App\Http\Controllers\Admin\PaymentMethodController::class,'create'])->name('admin.payment.create');
    Route::post('payment.create', [App\Http\Controllers\Admin\PaymentMethodController::class,'store'])->name('admin.payment.store');
    Route::get('payment.edit/{id}', [App\Http\Controllers\Admin\PaymentMethodController::class,'edit'])->name('admin.payment.edit');
    Route::put('payment.update/{id}', [App\Http\Controllers\Admin\PaymentMethodController::class,'update'])->name('admin.payment.update');
    Route::delete('payment.delete/{id}', [App\Http\Controllers\Admin\PaymentMethodController::class,'delete'])->name('admin.payment.delete');
    
    Route::put('payment/aktif/{id}', [App\Http\Controllers\Admin\PaymentMethodController::class,'aktif'])->name('admin.payment.aktif');
    Route::put('payment/non-aktif/{id}', [App\Http\Controllers\Admin\PaymentMethodController::class,'nonAktif'])->name('admin.payment.non.aktif');

    Route::get('discount', [App\Http\Controllers\Admin\DiscountController::class,'index'])->name('admin.discount');
    Route::get('discount/create', [App\Http\Controllers\Admin\DiscountController::class,'create'])->name('admin.discount.create');
    Route::post('discount.create', [App\Http\Controllers\Admin\DiscountController::class,'store'])->name('admin.discount.store');
    Route::get('discount.edit/{id}', [App\Http\Controllers\Admin\DiscountController::class,'edit'])->name('admin.discount.edit');
    Route::put('discount.update/{id}', [App\Http\Controllers\Admin\DiscountController::class,'update'])->name('admin.discount.update');
    Route::delete('discount.delete/{id}', [App\Http\Controllers\Admin\DiscountController::class,'delete'])->name('admin.discount.delete');

    Route::get('setting', [App\Http\Controllers\Admin\SettingController::class,'edit'])->name('admin.setting.edit');
    Route::put('setting.update', [App\Http\Controllers\Admin\SettingController::class,'update'])->name('admin.setting.update');

    Route::get('sales', [App\Http\Controllers\Admin\SalesController::class, 'index'])->name('admin.sales');
    Route::get('sales/create', [App\Http\Controllers\Admin\SalesController::class, 'create'])->name('admin.sales.create');
    Route::post('sales/create', [App\Http\Controllers\Admin\SalesController::class, 'createTransaction'])->name('admin.sales.create.action');
    Route::get('sales/{id}', [App\Http\Controllers\Admin\SalesController::class, 'detail'])->name('admin.sales.detail');

    Route::get('report/sales', [App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('admin.report.sales');
});