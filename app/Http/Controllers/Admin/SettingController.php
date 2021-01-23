<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Flash;

class SettingController extends Controller
{

  public function edit()
  {
    $setting = Setting::latest()->first();
    return view('admin.setting.edit', compact('setting'));
  }

  public function update(Request $request)
  {
  
    $setting = Setting::latest()->first();

    $setting->name = $request->input('name');
    $setting->is_active = $request->input('is_active');
    
    $setting->save();
    
    Flash::success('Data pengaturan berhasil di ubah.');
    return redirect()->route('admin.setting.edit');
           
           
      }
  

}
