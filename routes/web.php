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

        Route::get('customer', [App\Http\Controllers\Admin\CustomerController::class,'index'])->name('admin.customer');
        Route::get('customer/create', [App\Http\Controllers\Admin\CustomerController::class,'create'])->name('admin.customer.create');
        Route::post('customer.create', [App\Http\Controllers\Admin\CustomerController::class,'store'])->name('admin.customer.store');
        Route::get('customer.edit/{id}', [App\Http\Controllers\Admin\CustomerController::class,'edit'])->name('admin.customer.edit');
        Route::put('customer.update/{id}', [App\Http\Controllers\Admin\CustomerController::class,'update'])->name('admin.customer.update');
        Route::delete('customer.delete/{id}', [App\Http\Controllers\Admin\CustomerController::class,'delete'])->name('admin.customer.delete');

        Route::get('setting', [App\Http\Controllers\Admin\SettingController::class,'edit'])->name('admin.setting.edit');
        Route::put('setting.update', [App\Http\Controllers\Admin\SettingController::class,'update'])->name('admin.setting.update');
    });