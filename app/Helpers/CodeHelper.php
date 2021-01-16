<?php

namespace App\Helpers;
use App\Models\Memory;
use App\Models\Setting;

class CodeHelper {
  public function generateVoucherCode($outlet_code) {
    $memory = Memory::latest()->first();
    $setting = Setting::latest()->first();

    $memory->voucher_counter += 1;    

    $result = $setting->voucher_default_code_template;
    $result = str_replace('{outlet_code}', $outlet_code, $result);
    $result = str_replace('{number}', $memory->voucher_counter, $result);
    $memory->save();    
    return $result;
  }
}
