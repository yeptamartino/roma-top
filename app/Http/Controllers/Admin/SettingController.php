<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Helpers\ImageUploader;
use Flash;

class SettingController extends Controller
{

  public function edit()
  {
    $setting = Setting::latest()->first();
    return view('admin.setting.edit', compact('setting'));
  }

  public function update(Request $request, ImageUploader $imageUploader)
  {
    $request->validate(Setting::$validation);
    $setting = Setting::latest()->first();
    $setting->point_ratio = $request->input('point_ratio');

    if($request->file('thumbnail')) {
      $setting->logo = $imageUploader->saveImage($request, 'thumbnail');
    }

    $setting->save();
    
    Flash::success('Data pengaturan berhasil di ubah.');
    return redirect()->route('admin.setting.edit');
           
           
  }
  

}
