<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Constants;
use App\Helpers\ImageUploader;
use Flash;

class UserController extends Controller {

    public function index(Request $request) {
      $q = $request->input('search');      
      if($q) {
        $users = User::orderBy('name')->where(function($query) use ($q) {
          $query->where('name', 'LIKE', '%' . $q . '%');
          $query->orWhere('email', 'LIKE', '%' . $q . '%');

        })
        ->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
      } else {
        $users = User::where('role', Constants::$USER_ROLE_ADMIN)
          ->orderBy('created_at', 'desc')
          ->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
      }   
      return view('admin.admin.index', compact('users'));
    }
  
    public function create() {
      
      return view('admin.admin.create');
    }
  
    public function store(Request $request, ImageUploader $imageUploader) {
      $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'address' => $request->input('address'),
        'phone' => $request->input('phone'),
        'password' => $request->input('password'),
      ]);
      $user->thumbnail = $imageUploader->saveImage($request, 'thumbnail');
      $user->save();
      Flash::success('Data user berhasil di tambahkan.');
      return redirect()->route('admin.admin');
    }

    public function show($id) {
      $user = User::findOrFail($id);
      return view('admin.admin.detail', compact('user'));
    }
  
    public function edit($id) {
      $user = User::findOrFail($id);
      return view('admin.admin.edit', compact('user'));
    }
  
    public function update($id, Request $request, ImageUploader $imageUploader) {
      $user = User::findOrFail($id);
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->password = $request->input('password');
      if($request->file('thumbnail')) {
        $user->thumbnail    = $imageUploader->saveImage($request, 'thumbnail');
      }
      $user->save();
      Flash::success('Data user berhasil di ubah.');
      return redirect()->route('admin.admin');
    }
  
    public function delete($id) {
      $user = User::findOrFail($id);
      $user->delete();
      Flash::error('Data user berhasil di hapus.');
      return redirect()->route('admin.admin');
    }
}