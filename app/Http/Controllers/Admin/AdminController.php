<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ImageUploader;
use App\Models\Constants;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\User;
use Flash;
class AdminController extends Controller
{
    public function dashboard(){
        
        $user_count = User::orderBy('created_at', 'desc')
        ->where('role', Constants::$USER_ROLE_ADMIN)
        ->count();
        
        $users = User::orderBy('created_at', 'desc')
        ->where('role', Constants::$USER_ROLE_CUSTOMER)
        ->limit(10)->get();

        $catalog_count = Catalog::count();
        $category_count = Category::count();

        return view(
          'admin.dashboard',
          compact(
            'users',
            'user_count',
            'category_count',
            'catalog_count',
          ));
    }
    public function admin(Request $request) {
      $keyword = $request->get('keyword');
      $tgl_awal = $request->get('tgl_awal');
      $tgl_akhir = $request->get('tgl_akhir');
      $type = $request->get('type');
      $action = $request->get('action');
      
      $queryBuilder = User::where('role', Constants::$USER_ROLE_ADMIN);
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

    public function create() {
      return view('admin.admin.create');
    }

    public function show($id) {
      $admin = User::findOrFail($id);
      return view('admin.admin.detail', compact('admin'));
    }
  
    public function store(Request $request, ImageUploader $imageUploader) {
      $admin = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'password' => bcrypt($request->input('password')),
        'role' => Constants::$USER_ROLE_ADMIN,
      ]);
      $admin->thumbnail = $imageUploader->saveImage($request, 'thumbnail');
      $admin->save();
      return redirect()->route('admin.admin');
    }
  
    public function edit($id) {
      $admin = User::findOrFail($id);
      return view('admin.admin.edit', compact('admin'));
    }

    public function update($id, Request $request, ImageUploader $imageUploader)
    {
      $user = User::findOrFail($id);
  
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->phone = $request->input('phone');
      $user->address = $request->input('address');
      if($request->input('password')) {
        $user->password = bcrypt($request->input('password'));
      }    
      
      if($request->file('thumbnail')) {
        $user->thumbnail    = $imageUploader->saveImage($request, 'thumbnail');
      }
      $user->save();
      
      Flash::success('Data admin berhasil di ubah.');
      return redirect()->route('admin.admin');
    }

    public function delete($id) {
      $admin = User::findOrFail($id);
      $admin->delete();
      Flash::error('Data admin berhasil di hapus.');
      return redirect()->route('admin.admin');
    }
}
