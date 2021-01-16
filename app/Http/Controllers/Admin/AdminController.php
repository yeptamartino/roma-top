<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ImageUploader;
use Illuminate\Http\Request;
use App\Models\Constants;
use App\Models\Admin;
use Flash;

class AdminController extends Controller
{

  public function index(Request $request)
  {
    $keyword = $request->get('keyword');
      $tgl_awal = $request->get('tgl_awal');
      $tgl_akhir = $request->get('tgl_akhir');
      $type = $request->get('type');
      $action = $request->get('action');
      
      $queryBuilder = Admin::where('role', Constants::$USER_ROLE_ADMIN);
      if($type){
        $queryBuilder->where('is_verified', $type);
      }
      if ($tgl_awal &&  $tgl_akhir){
        $queryBuilder->whereBetween('created_at', [$tgl_awal, $tgl_akhir]);
      }
      if($keyword) {
        $queryBuilder->where(function ($query) use ($keyword) {
          $query->orWhere('name','LIKE',"%$keyword%");
          $query->orWhere('email','LIKE',"%$keyword%");
        }); 
      }
    
      $queryBuilder->orderBy('updated_at','desc');

      $admins_count = $queryBuilder->count();
      $admins = $queryBuilder->orderBy('created_at','desc')
        ->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
      
      return view('admin.admin.index', compact('admins','admins_count'));
  }

  public function create()
  {
    return view('admin.admin.create');
  }

  public function store(Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Admin::$validation);
    $admin = new Admin([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'password' => bcrypt($request->input('password')),
        'role' => Constants::$USER_ROLE_ADMIN,
    ]);
    $admin->thumbnail = $imageUploader->saveImage($request, 'thumbnail');
    Flash::success('Data admin berhasil di tambahkan.');
    $admin->save();

    return redirect()->route('admin.admin');
  }

  public function edit($id)
  {
    $admin = Admin::findOrFail($id);
    return view('admin.admin.edit', compact('admin'));
  }

  public function update($id, Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Admin::$validationUpdate);
    $admin = Admin::findOrFail($id);
      $admin->name = $request->input('name');
      $admin->email = $request->input('email');
      $admin->phone = $request->input('phone');
      $admin->address = $request->input('address');
    
    if($request->file('thumbnail')) {
      $admin->thumbnail    = $imageUploader->saveImage($request, 'thumbnail');
    }
    Flash::success('Data admin berhasil di ubah.');
    $admin->save();

    return redirect()->route('admin.admin');
  }

  public function delete($id)
  {
    $admin = Admin::findOrFail($id);
    $admin->delete();
    Flash::error('Data admin berhasil di hapus.');
    return redirect()->route('admin.admin');
  }
}
