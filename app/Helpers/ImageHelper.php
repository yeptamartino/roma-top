<?php

namespace App\Helpers;

use ImageOptimizer;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class ImageHelper {
  public function generateOutletsQRCode($outlets) {
    ini_set('max_execution_time', 2 * 3600);
    $types = ['A', 'B'];
    foreach($outlets as $outlet) {
      for($i = 0; $i < 2; $i++) {
        $type = $types[$i];
        $this->generateOutletQRCode($outlet, $type);
      }
    }
  }

  public function generateOutletQRCode($outlet, $type) {    
    $image_name = $outlet->code . '_' . $type;
    $canvas = Image::canvas(1123, 1654);
    $canvas->insert(public_path('assets/images/template-outlet-qr-code-' . strtolower($type) . '.jpg'));
    QrCode::format('png')
      ->size(600)
      ->generate($image_name, public_path('qrcodes/' . $image_name . '.png'));

    $watermark = Image::make(public_path('qrcodes/' . $image_name . '.png'));
    $canvas->insert($watermark, 'top-left', (int)((1123 / 2) - 600 / 2), 700);
    $canvas->save(public_path('qrcoderesults/' . $image_name . '.jpg'));

    return public_path('qrcoderesults/' . $image_name . '.jpg');
  }

  public function compressImageBase64($imagebase64, $extension) {
    // compress still failed
    // $path = $this->saveTmpImageBase64($imagebase64, $extension);    
    // ImageOptimizer::optimize($path);
    // $type = pathinfo($path, PATHINFO_EXTENSION);
    // $data = file_get_contents($path);        
    // $result = base64_encode($data);
    return $imagebase64;
  }

  public function saveTmpImage($url) {
    $tmp = explode('.', $url);
    $image_name = Str::uuid() . '.' . $tmp[count($tmp) - 1];
    $img = public_path('tmp') . '/' . $image_name;
    file_put_contents($img, file_get_contents($url));
    return $img;
  }

  public function saveTmpImageBase64($img, $extension) {
    $image_name = Str::uuid() . '.' . $extension;  
    $path = public_path('tmp') . '/' . $image_name;  
    $imgbuilder = Image::make($img);
    if($imgbuilder->width() > 800) {
      $imgbuilder = $imgbuilder->resize(800, null, function ($constraint) {
        $constraint->aspectRatio();
      });
    }
    $imgbuilder->save($path);
    return $path;
  }

  public function deleteImage($image_path) {
    unlink($image_path);
  }
}
