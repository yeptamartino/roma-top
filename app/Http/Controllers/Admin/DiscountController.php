<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use Flash;
class DiscountController extends Controller
{

  public function index(Request $request)
  {
    $valsearch = preg_replace('/[^A-Za-z0-9 ]/', '', $request->input('search'));

    if ($valsearch == "" || $valsearch == "0") {

      $q_search = "";
    } else {
      $q_search = " AND name like '%" . $valsearch . "%'";
    }
    $discounts = Discount::whereRaw('1 ' . $q_search)
      ->orderBy('name', 'asc')
      ->paginate(10);
    return view('admin.discount.index', compact('discounts'));
  }

  public function create()
  {
    return view('admin.discount.create');
  }

  public function store(Request $request)
  {
    $request->validate(Discount::$validation);

    $discount = new Discount([
      'name'        => $request->input('name'),
      'description' => $request->input('description'),
      'type'        => $request->input('type'),
      'amount'       => $request->input('amount'),
    ]);

    $discount->save();
    Flash::success('Data diskon berhasil di tambahkan.');
    return redirect()->route('admin.discount');
  }

  public function edit($id)
  {
    $discount = Discount::findOrFail($id);
    return view('admin.discount.edit', compact('discount'));
  }

  public function update($id, Request $request)
  {
    $discount = Discount::findOrFail($id);

    $discount->name         = $request->input('name');
    $discount->description  = $request->input('description');
    $discount->type         = $request->input('type');
    $discount->amount        = $request->input('amount');
  
    $discount->save();
    Flash::success('Data diskon berhasil di ubah.');
    return redirect()->route('admin.discount');
  }

  public function delete($id)
  {
    $discount = Discount::findOrFail($id);
    $discount->delete();
    Flash::error('Data discount berhasil di hapus.');
    return redirect()->route('admin.discount');
  }
}
