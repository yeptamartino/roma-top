<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Constants;
use Flash;
use App\Repositories\ImageHostingRepository;
use App\Helpers\ActionLoggerHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function edit()
    {
      $setting = Setting::latest()->first();
      return view('admin.settings.edit', compact('setting'));
    }
  
    public function update(Request $request, ImageHostingRepository $imageRepository, ActionLoggerHelper $actionLogger)
    {
      $request->validate(Setting::$validation);
      
      $setting = Setting::latest()->first();
  
      $setting->voucher_creation_threshold = $request->input('voucher_creation_threshold');
      $setting->scan_wait_time_minute = $request->input('scan_wait_time_minute');
      $setting->voucher_default_title = $request->input('voucher_default_title') ?? '';
      $setting->voucher_default_description = $request->input('voucher_default_description') ?? '';
      $setting->voucher_default_code_template = $request->input('voucher_default_code_template');
      $setting->voucher_default_expired_date = $request->input('voucher_default_expired_date');
      $setting->post_show_limit = $request->input('post_show_limit');
      $setting->banner_show_limit = $request->input('banner_show_limit');
      // $setting->terms_and_conditions = $request->input('terms_and_conditions');
      $setting->lottery_wait_time = $request->input('lottery_wait_time');
      $setting->event_start_date = $request->input('event_start_date');
      $setting->event_end_date = $request->input('event_end_date');
      $setting->home_text_title = $request->input('home_text_title') ?? '';
      $setting->home_text_description = $request->input('home_text_description') ?? '';
      $setting->privacy_policy_html = $request->input('privacy_policy_html');

      if($request->file('notification_default_image')){
        $image_path = $request->file('notification_default_image')->path();
        $extension = $request->file('notification_default_image')->extension();
        $image = base64_encode(file_get_contents($image_path));
        $image_url = $imageRepository->upload($image, $extension);
        $setting->notification_default_image = $image_url;
      }

      // if($request->file('voucher_default_image')){
      //   $image_path = $request->file('voucher_default_image')->path();
      //   $extension = $request->file('voucher_default_image')->extension();
      //   $image = base64_encode(file_get_contents($image_path));
      //   $image_url = $imageRepository->upload($image, $extension);
      //   $setting->voucher_default_image = $image_url;
      // }
      
      $setting->save();

      $actionLogger->logAction(
        Constants::$ACTION_LOGGER_UPDATE_SETTING,
        $setting,
      );
      
      Flash::success('Data pengaturan berhasil di ubah.');
      return redirect()->route('admin.settings.edit');
    }
  

    public function updatePassword() {
      return view('admin.settings.update-password');
    }

    public function updatePasswordAction(Request $request) {
      $old_password = $request->input('old_password');
      $new_password = $request->input('new_password');

      $request->validate([
        'old_password' => 'required|string|min:8',
        'new_password' => 'required|string|min:8',
      ]);

      if(Hash::check($old_password, Auth::user()->password)) {
          $user = Auth::user();
          $user->password = bcrypt($new_password);
          $user->save();
          Flash::success('Password berhasil di ubah.');
      } else {
        Flash::error('Password lama yang anda masukkan salah');        
      }
      return redirect()->back();
    }
}
