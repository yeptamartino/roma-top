<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{

  public function index(Request $request)
  {
    $valsearch = preg_replace('/[^A-Za-z0-9 ]/', '', $request->input('search'));

    if ($valsearch == "" || $valsearch == "0") {
      $q_search = "";
    } else {
      $q_search = " AND name like '%" . $valsearch . "%'";
    }
    $payments = PaymentMethod::whereRaw('1 ' . $q_search)
      ->orderBy('name', 'asc')
      ->paginate(10);
    return view('admin.payment.index', compact('payments'));
  }

  public function create()
  {
    return view('admin.payment.create');
  }

  public function store(Request $request)
  {

    $payment = new PaymentMethod([
      'name' => $request->input('name'),
      'is_active' => $request->input('is_active')
    ]);

    $payment->save();

    return redirect()->route('admin.payment');
  }

  public function edit($id)
  {
    $payment = PaymentMethod::findOrFail($id);
    return view('admin.payment.edit', compact('payment'));
  }

  public function update($id, Request $request)
  {
    $payment = PaymentMethod::findOrFail($id);

    $payment->name = $request->input('name');
    $payment->is_active = $request->input('is_active');
    $payment->save();

    return redirect()->route('admin.payment');
  }

  public function delete($id)
  {
    $payment = PaymentMethod::findOrFail($id);
    $payment->delete();
    return redirect()->route('admin.payment');
  }
}