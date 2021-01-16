<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
// use ImageOptimizer;

class ImageUploader {
  private $IMAGE_PATH = 'images';

  public function saveImage(Request $request, $name) {
    if ($request->file($name)) {
      $imagePath = $request->file($name);
      $uuid = Str::uuid()->toString();
      $imageName = $uuid . '-' . $imagePath->getClientOriginalName();
      $request->thumbnail->move(public_path($this->IMAGE_PATH), $imageName);
      // $pathToImage = public_path($this->IMAGE_PATH .'/'. $imageName);
      // ImageOptimizer::optimize($pathToImage);
      return $imageName;
    }
    return '';
  }

  public function saveImages(Request $request, $name) {
    $uploadedImages = [];
    if($files = $request->file($name)){
      foreach($files as $file){          
          $uuid = Str::uuid()->toString();
          $imageName = $uuid . '-' . $file->getClientOriginalName();
          $file->move(public_path($this->IMAGE_PATH), $imageName); 
          // $pathToImage = public_path($this->IMAGE_PATH .'/'. $imageName);
          // ImageOptimizer::optimize($pathToImage);
          array_push($uploadedImages, $imageName);
      }
    }   
    return $uploadedImages;
  }

  public function removeImage(Request $request, $name) {
    $image_path = "/".$this->IMAGE_PATH."/" . $name;
    if(File::exists($image_path)) {
        File::delete($image_path);
    }
  }
}