<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Constants;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Helpers\ExcelHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\ActionLoggerHelper;
use App\Helpers\CacheHelper;

class UserController extends Controller {
  
public function index(Request $request, ExcelHelper $excelHelper, ActionLoggerHelper $actionLogger) {
  $keyword = $request->get('keyword');
  $tgl_awal = $request->get('tgl_awal');
  $tgl_akhir = $request->get('tgl_akhir');
  $type = $request->get('type');
  $action = $request->get('action');
  
  $queryBuilder = User::where('role', Constants::$USER_ROLE_CUSTOMER);
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
  
  if($action === 'Excel' || $action === 'Pdf') {

    $actionLogger->logAction(
      Constants::$ACTION_LOGGER_DOWNLOAD_USER_DATA,
      $request->all(),
    );

    if(!$tgl_awal || !$tgl_akhir) {
      return redirect()->back()->with('error', Constants::$_MESSAGE_EXPORT_EXCEL_PDF_NO_DATES);
    }
    return Excel::download(
      new UserExport($queryBuilder->get()),
      $excelHelper->generateExcelFileName(
        'User',
        $keyword,
        $tgl_awal,
        $tgl_akhir,
        $action === 'Excel' ? 'xlsx' : 'pdf'
      )
    );
  }
  $users_count = $queryBuilder->count();
  $users = $queryBuilder->orderBy('created_at','desc')
    ->paginate(Constants::$DEFAULT_PAGINATION_COUNT);
  
  return view('admin.users.index', compact('users','users_count'));
}
  
    public function create() {
      return view('admin.users.create');
    }

    public function show($id) {
      $user = User::findOrFail($id);      
      return view('admin.users.detail', compact('user'));
    }

    public function verify($id, NotificationHelper $notificationHelper, ActionLoggerHelper $actionLogger, CacheHelper $cacheHelper) {
      $user = User::findOrFail($id);

      $cacheHelper->put($user->email, null);
      
      $notificationHelper->sendMessage(
        $user->fcm_token,
        $user->id,
        'Verifikasi KTP Anda berhasil.',
        'Tim Air Minum Biru telah memverifikasi KTP anda. Sekarang anda bisa mulai melakukan scan QR Code untuk mendapatkan kupon undian.',
        null,
        '',
        Constants::$NAVIGATION_KEY_MY_ACCOUNT,  
      );
      $user->is_verified = Constants::$KTP_VERIFICATION_STATUS_VERIFIED;
      $user->save();      

      $actionLogger->logAction(
        Constants::$ACTION_LOGGER_VERIFY_KTP_USER,
        $user,
      );

      return redirect()->route('admin.users.detail', ['id' => $id]);
    }

    public function unverify($id, NotificationHelper $notificationHelper, ActionLoggerHelper $actionLogger, CacheHelper $cacheHelper) {
      $user = User::findOrFail($id);

      $cacheHelper->put($user->email, null);

      $notificationHelper->sendMessage(
        $user->fcm_token,
        $user->id,
        'Verifikasi KTP Anda ditolak.',
        'Tim Air Minum Biru menolak verifikasi KTP anda. Silahkan ganti anda dengan yang lebih jelas dan tepat.',
        null,
        '',
        Constants::$NAVIGATION_KEY_MY_ACCOUNT,  
      );
      $user->is_verified = Constants::$KTP_VERIFICATION_STATUS_REJECTED;
      $user->save();      

      $actionLogger->logAction(
        Constants::$ACTION_LOGGER_UNVERIFY_KTP_USER,
        $user,
      );

      return redirect()->route('admin.users.detail', ['id' => $id]);
    }
  
    public function store(Request $request) {
      $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'address' => $request->input('address'),
        'is_verified' => $request->input('is_verified'),
        'no_ktp' => $request->input('no_ktp'),
        'password' => bcrypt($request->input('password')),
        'role' => $request->input('role'),
    
      ]);
  
      $user->save();
      return redirect()->route('admin.users');
    }
  
    public function edit($id) {
      $user = User::findOrFail($id);
      return view('admin.users.edit', compact('user'));
    }

    public function delete($id, ActionLoggerHelper $actionLogger) {
      $user = User::findOrFail($id);
      $user->delete();
      $actionLogger->logAction(
        Constants::$ACTION_LOGGER_DELETE_CUSTOMER,
        $user,
      );
      Flash::error('Data berhasil di hapus.');
      return redirect()->route('admin.users');
    }

    public function verifyMultiple(Request $request, NotificationHelper $notificationHelper, CacheHelper $cacheHelper) {
      $submit_verifikasi = $request->input('submit_verifikasi');
      $selected_users = $request->input('selected_users');
      
      if($selected_users) {
        $users = User::whereIn('id', $selected_users);

        if($users) {
          if($submit_verifikasi === 'Verifikasi') {
            $users->update([
              'is_verified' => Constants::$KTP_VERIFICATION_STATUS_VERIFIED,
            ]);
            
            foreach($users->get() as $user) {
              $cacheHelper->put($user->email, null);

              $notificationHelper->sendMessage(
                $user->fcm_token,
                $user->id,
                'Verifikasi KTP Anda berhasil.',
                'Tim Air Minum Biru telah memverifikasi KTP anda. Sekarang anda bisa mulai melakukan scan QR Code untuk mendapatkan kupon undian.',
                null,
                '',
                Constants::$NAVIGATION_KEY_MY_ACCOUNT,  
              );              
            }
          }
          if($submit_verifikasi === 'Tolak Verifikasi') {
            $users->update([
              'is_verified' => Constants::$KTP_VERIFICATION_STATUS_REJECTED,
            ]);

            foreach($users->get() as $user) {
              $notificationHelper->sendMessage(
                $user->fcm_token,
                $user->id,
                'Verifikasi KTP Anda ditolak.',
                'Tim Air Minum Biru menolak verifikasi KTP anda. Silahkan ganti anda dengan yang lebih jelas dan tepat.',
                null,
                '',
                Constants::$NAVIGATION_KEY_MY_ACCOUNT,  
              );
            }
          }
        }
      }
      return redirect()->back();
    }
}
