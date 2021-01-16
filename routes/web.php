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

Route::get('/', function () {
    return view('admin.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('category', [App\Http\Controllers\Admin\CategoryController::class,'index'])->name('admin.category');
Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class,'create'])->name('admin.category.create');
Route::post('category.create', [App\Http\Controllers\Admin\CategoryController::class,'store'])->name('admin.category.store');
Route::get('category.edit/{id}', [App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('admin.category.edit');
Route::put('category.update/{id}', [App\Http\Controllers\Admin\CategoryController::class,'update'])->name('admin.category.update');
Route::delete('category.delete/{id}', [App\Http\Controllers\Admin\CategoryController::class,'delete'])->name('admin.category.delete');
