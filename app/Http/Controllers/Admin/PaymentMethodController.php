<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Constants;
use App\Models\Constans;
use Flash;
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
    $request->validate(PaymentMethod::$validation);
    $payment = new PaymentMethod([
      'name' => $request->input('name'),
      'is_active' => 0,
    ]);

    $payment->save();
    Flash::success('Metode pembayaran berhasil di tambahkan.');
    return redirect()->route('admin.payment');
  }

  public function edit($id)
  {
    $payment = PaymentMethod::findOrFail($id);
    return view('admin.payment.edit', compact('payment'));
  }

  public function update($id, Request $request)
  {
    $request->validate(PaymentMethod::$validation);
    $payment = PaymentMethod::findOrFail($id);
    $payment->name = $request->input('name');
    $payment->is_active = $request->input('is_active');
    $payment->save();
    Flash::success('Metode pembayaran berhasil di ubah.');

    return redirect()->route('admin.payment');
  }

  public function aktif($id) {
    $payment = PaymentMethod::findOrFail($id);

    $payment->is_active = 1;
    $payment->save();      

    return redirect()->route('admin.payment');
  }

  public function nonAktif($id) {
    $payment = PaymentMethod::findOrFail($id);

    $payment->is_active = 0;
    $payment->save();      

    return redirect()->route('admin.payment');
  }

  public function delete($id)
  {
    $payment = PaymentMethod::findOrFail($id);
    $payment->delete();
    Flash::error('Metode pembayaran berhasil di hapus.');
    return redirect()->route('admin.payment');
  }
}
