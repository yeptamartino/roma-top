<?php

namespace App\Helpers;

use App\Models\Setting;
use App\Models\Outlet;
use App\Models\Scan;
use App\Models\Voucher;
use App\Constants;
use Carbon\Carbon;
use App\Helpers\CodeHelper;
use App\Helpers\NotificationHelper;

class ScanHelper {
  private $setting;

  public function __construct() {
    $this->setting = Setting::latest()->first();
  }

  public function insertToScan($data) {
    $codeHelper = resolve('App\Helpers\CodeHelper');
    $notification = resolve('App\Helpers\NotificationHelper');
    $user = $data['user'];
    $outlet_code = $data['outlet_code'];
    $key_type = $data['key_type'];
    $quantity = (int) $data['quantity'];
    
    $setting = $this->setting;
    $current_date_time = Carbon::now();
    $event_start_date = Carbon::parse($setting->event_start_date);
    $event_end_date = Carbon::parse($setting->event_end_date);
    
    if($quantity > config('app.user_max_scan')) {
      return [
        'error' => true,
        'message' => 'Maaf, anda memasukkan jumlah scan di luar batas toleransi kami.'
      ];
    }

    if($user->is_verified !== Constants::$KTP_VERIFICATION_STATUS_VERIFIED) {
      return [
        'error' => true,
        'message' => 'KTP Anda belum terverifikasi. Silahkan verifikasi terlebih dahulu.'
      ];
    }
    
    if($current_date_time->lessThan($event_start_date)) {
      return [
        'error' => true,
        'message' => 'Event Gebyar 500 Air Minum Biru belum dimulai.'
      ];
    }

    if($current_date_time->greaterThan($event_end_date)) {
      return [
        'error' => true,
        'message' => 'Event Gebyar 500 Air Minum Biru sudah selesai.'
      ];
    }
    
    $outlet = Outlet::where('code', $outlet_code)->first();
    if(!$outlet) {
      return [
        'error' => true,
        'message' => 'Outlet tidak ditemukan'
      ];
    }

    $latest_scan = Scan::where('user_id', $user->id)->latest()->first();

    if($latest_scan) {
      $latest_scan_date_time = Carbon::parse($latest_scan->created_at);
      if($current_date_time->diffInMinutes($latest_scan_date_time) < $setting->scan_wait_time_minute) {
        return [
          'error' => true,
          'message' => 'Silahkan tunggu beberapa saat lagi untuk melakukan scan.'
        ];
      }
    }

    $scan = new Scan([
      'outlet_code' => $outlet_code,
      'key_type' => $key_type,
      'quantity' => $quantity,
      'galon_price' => $outlet->city->galon_price,
      'user_id' => $user->id,
    ]);
    $scan->save();

    $scan_count = Scan::where('user_id', $user->id)
      ->where('outlet_code', $outlet_code)->sum('quantity');
    $current_generated_voucher = Voucher::where('user_id', $user->id)
      ->where('outlet_code', $outlet_code)->count();

    $expected_generated_voucher = intval($scan_count / $setting->voucher_creation_threshold);

    $current_and_expected_generated_voucher_diff = $expected_generated_voucher - $current_generated_voucher;

    if($current_and_expected_generated_voucher_diff > 0) {        
      $vouchers = [];
      for ($i=0; $i < $current_and_expected_generated_voucher_diff; $i++) { 
        array_push($vouchers, [
          'code' => $codeHelper->generateVoucherCode($outlet_code),
          'outlet_code' => $outlet_code,
          'title' => $setting->voucher_default_title,
          'description' => $setting->voucher_default_description,
          'image' => $setting->voucher_default_image,
          'expired_at' => Carbon::parse($setting->voucher_default_expired_date),
          'user_id' => $user->id,
          'created_at' => $current_date_time->toDateTimeString(),
          'updated_at' => $current_date_time->toDateTimeString(),
        ]);          
      }

      if(count($vouchers) > 0) {
        Voucher::insert($vouchers);
      }

      $notification->sendMessage(
        $user->fcm_token,
        $user->id,
        'Selamat anda mendapatkan kupon undian!',
        'Kumpulkan terus kupon undian anda, dapatkan hadiah utama dari Gebyar 500 Air Minum Biru!',
        null, null, Constants::$NAVIGATION_KEY_COUPONS_SCREEN
      );    

      return [
        'error' => false,
        'message' => 'Selamat anda mendapatkan kupon!',
      ];
    }     

    $notification->sendMessage(
      $user->fcm_token,
      $user->id,
      'Scan berhasil!',
      'Tingkatkan terus transaksi anda untuk mendapatkan kupon undian Gebyar 500 Air Minum Biru!',
      null, null, Constants::$NAVIGATION_KEY_SCANS_HISTORY_SCREEN
    );

    return [
      'error' => false,
      'message' => 'Scan QRCode berhasil.',
    ];
  }
}