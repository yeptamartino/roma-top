<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Helpers\ImageUploader;
use Flash;
class CustomerController extends Controller
{

  public function index(Request $request)
  {
    $valsearch = preg_replace('/[^A-Za-z0-9 ]/', '', $request->input('search'));

    if ($valsearch == "" || $valsearch == "0") {

      $q_search = "";
    } else {
      $q_search = " AND name like '%" . $valsearch . "%'";
    }
    $customers = Customer::whereRaw('1 ' . $q_search)
      ->orderBy('name', 'asc')
      ->paginate(10);
    return view('admin.customer.index', compact('customers'));
  }

  public function create()
  {
    return view('admin.customer.create');
  }

  public function store(Request $request, ImageUploader $imageUploader)
  {
    
   
    $customer = new Customer([
      'name' => $request->input('name'),
      'phone' => $request->input('phone'),
      'email' => $request->input('email'),
      'first_visit' => $request->input('first_visit'),
      'last_visit' => $request->input('last_visit'),
      'total_visit' => $request->input('total_visit'),
      'address' => $request->input('address'),
      'total_paid' => $request->input('total_paid'),
      'point' => $request->input('point'),
      'note' => $request->input('note'),
    ]);
    $customer->thumbnail = $imageUploader->saveImage($request, 'thumbnail');

    $customer->save();
    Flash::success('Data customer berhasil di tambahkan.');

    return redirect()->route('admin.customer');
  }

  public function edit($id)
  {
    $customer = Customer::findOrFail($id);
    return view('admin.customer.edit', compact('customer'));
  }

  public function update($id, Request $request, ImageUploader $imageUploader)
  {
    $customer = Customer::findOrFail($id);

    $customer->name = $request->input('name');
    $customer->address = $request->input('address');
    $customer->phone = $request->input('phone');
    $customer->email = $request->input('email');
    $customer->first_visit = $request->input('first_visit');
    $customer->last_visit = $request->input('last_visit');
    $customer->total_visit = $request->input('total_visit');
    $customer->total_paid = $request->input('total_paid');
    $customer->point = $request->input('point');
    $customer->note = $request->input('note');

    if($request->file('thumbnail')) {
        $customer->thumbnail    = $imageUploader->saveImage($request, 'thumbnail');
      }
  
    $customer->save();
    Flash::success('Data customer berhasil di ubah.');
    return redirect()->route('admin.customer');
  }

  public function delete($id)
  {
    $customer = Customer::findOrFail($id);
    $customer->delete();
    Flash::error('Data customer berhasil di hapus.');
    return redirect()->route('admin.customer');
  }
}
