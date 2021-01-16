<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Outlet;
use App\Models\Scan;
use App\Models\Voucher;
use Flash;
use App\Helpers\NotificationHelper;
use App\Constants;
class AdminController extends Controller
{
    public function dashboard(){
        
        $user_count = User::orderBy('created_at', 'desc')
        ->where('role', Constants::$USER_ROLE_CUSTOMER)
        ->count();
        
        $users = User::orderBy('created_at', 'desc')
        ->where('role', Constants::$USER_ROLE_CUSTOMER)
        ->limit(10)->get();
        
        $outlet_count = Outlet::count();
        $scan_count = Scan::count();
        $voucher_count = Voucher::count();

        $top_users = User::orderBy('scans_count', 'desc')
          ->where('role', Constants::$USER_ROLE_CUSTOMER)
          ->withCount('scans')->limit(10)->get();

        $top_outlets = Outlet::orderBy('scans_count', 'desc')
          ->withCount('scans')->limit(10)->get();
          
        $lowest_outlets = Outlet::orderBy('scans_count', 'asc')
          ->withCount('scans')->limit(10)->get();

        return view(
          'admin.dashboard',
          compact(
            'users',
            'user_count',
            'outlet_count',
            'scan_count',
            'voucher_count',
            'top_users',
            'top_outlets',
            'lowest_outlets',
          ));
    }

    public function top(Request $request) {
      $order_by = $request->get('order_by') ?? 'desc';
      $top_outlets = Outlet::orderBy('scans_count', $order_by)
          ->withCount('scans')->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
       
          return view('admin.top-gerai',compact('top_outlets'));

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
          $query->orWhere('no_ktp','LIKE',"%$keyword%");
        }); 
      }
    
      $queryBuilder->orderBy('updated_at','desc');

      $admins_count = $queryBuilder->count();
      $admins = $queryBuilder->orderBy('created_at','desc')
        ->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
      
      return view('admin.admins.index', compact('admins','admins_count'));
    }

    public function create() {
      return view('admin.admins.create');
    }

    public function show($id) {
      $admin = User::findOrFail($id);
      return view('admin.admins.detail', compact('admin'));
    }

    public function verify($id, NotificationHelper $notificationHelper) {
      $admin = User::findOrFail($id);
      $notificationHelper->sendMessage(
        $admin->fcm_token,
        $admin->id,
        'Verifikasi KTP Anda berhasil.',
        'Tim Air Minum Biru telah memverifikasi KTP anda. Sekarang anda bisa mulai melakukan scan QR Code untuk mendapatkan kupon undian.',
        null,
        '',
        Constants::$NAVIGATION_KEY_MY_ACCOUNT,  
      );
      $admin->is_verified = Constants::$KTP_VERIFICATION_STATUS_VERIFIED;
      $admin->save();
      return redirect()->route('admin.admins.detail', ['id' => $id]);
    }

    public function unverify($id, NotificationHelper $notificationHelper) {
      $admin = User::findOrFail($id);
      $notificationHelper->sendMessage(
        $admin->fcm_token,
        $admin->id,
        'Verifikasi KTP Anda ditolak.',
        'Tim Air Minum Biru menolak verifikasi KTP anda. Silahkan ganti anda dengan yang lebih jelas dan tepat.',
        null,
        '',
        Constants::$NAVIGATION_KEY_MY_ACCOUNT,  
      );
      $admin->is_verified = Constants::$KTP_VERIFICATION_STATUS_REJECTED;
      $admin->save();
      return redirect()->route('admin.admins.detail', ['id' => $id]);
    }
  
    public function store(Request $request) {
      $request->validate(Admin::getValidation());
      $admin = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'is_verified' => Constants::$KTP_VERIFICATION_STATUS_VERIFIED,
        'no_ktp' => $request->input('no_ktp'),
        'password' => bcrypt($request->input('password')),
        'role' => Constants::$USER_ROLE_ADMIN,
      ]);
  
      $admin->save();
      return redirect()->route('admin.admins');
    }
  
    public function edit($id) {
      $admin = User::findOrFail($id);
      return view('admin.admins.edit', compact('admin'));
    }

    public function update($id, Request $request)
    {
      $request->validate(Admin::getValidation($id));
      $user = User::findOrFail($id);
  
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->phone = $request->input('phone');
      $user->address = $request->input('address');
      $user->no_ktp = $request->input('no_ktp');
      if($request->input('password')) {
        $user->password = bcrypt($request->input('password'));
      }      
      $user->save();
      
      Flash::success('Data admin berhasil di ubah.');
      return redirect()->route('admin.admins');
    }

    public function delete($id) {
      $admin = User::findOrFail($id);
      $admin->delete();
      Flash::error('Data admin berhasil di hapus.');
      return redirect()->route('admin.admins');
    }
}
