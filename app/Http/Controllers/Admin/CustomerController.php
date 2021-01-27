<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Constants;
use App\Helpers\ImageUploader;
use Flash;
class CustomerController extends Controller
{

  public function index(Request $request)
  {
    $search = $request->get('search');
    $customers = Customer::orderBy('created_at', 'desc');
    if($search) {
      $customers =  $customers->where(function ($query) use ($search){
        $query->orWhere('name','LIKE',"%$search%");
        $query->orWhere('phone','LIKE',"%$search%");
        $query->orWhere('email','LIKE',"%$search%");
      });
    }

    $customers = $customers->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
    return view('admin.customer.index', compact('customers'));
  }

  public function create()
  {
    return view('admin.customer.create');
  }

  public function store(Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Customer::$validation);
    $customer = new Customer([
      'name' => $request->input('name'),
      'phone' => $request->input('phone'),
      'email' => $request->input('email'),
      'first_visit' => null,
      'last_visit' => null,
      'total_visit' => 0,
      'address' => $request->input('address'),
      'total_paid' => 0,
      'point' => 0,
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
    $request->validate(Customer::$validationUpdate);
    $customer = Customer::findOrFail($id);

    $customer->name = $request->input('name');
    $customer->address = $request->input('address');
    $customer->phone = $request->input('phone');
    $customer->email = $request->input('email');
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
