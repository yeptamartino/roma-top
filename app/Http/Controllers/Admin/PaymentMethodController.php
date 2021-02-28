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
    $payments = PaymentMethod::orderBy('updated_at', 'desc')->limit(1000)->get();
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
      'is_active' => $request->input('is_active'),
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
    Flash::success('Metode pembayaran berhasil di hapus.');
    return redirect()->route('admin.payment');
  }
}
