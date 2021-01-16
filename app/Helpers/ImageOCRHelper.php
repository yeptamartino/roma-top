<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ImageOCRHelper {
  public function readNIKAndNameOnKTP($image_url) {
    $imageHelper = resolve('App\Helpers\ImageHelper');
    $imagePath = $imageHelper->saveTmpImage('https://ghack-cloudstorage.cloud/api/image/airbiru/22470311-c4c1-4b02-9662-67c102415c21.jpg');
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->thresholdimage(0.4 * \Imagick::getQuantum(), '134217727');
    $image_make = Image::make($imagick->getImageBlob())
      ->contrast(100);
    $image_make->save($imagePath);
    $list_numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $list_symbols = ['-', ' ', ':'];
    $list_characters = range('A', 'Z');
    $list_characters_lower = range('a', 'z');
    $ocr = (new TesseractOCR($imagePath))
    ->allowlist(array_merge(
      $list_numbers,
      $list_characters,
      $list_symbols,
      $list_characters_lower
    ))
    ->run();
    $imageHelper->deleteImage($imagePath);
    $ocr_lines = explode("\n", $ocr);

    $result_nik = '';
    $result_nama = '';
    foreach($ocr_lines as $line) {
      if (strpos($line, 'NIK') !== false) {
        $nik = str_replace('NIK', '', $line);
        $nik = str_replace(' ', '', $nik);
        $nik = str_replace(':', '', $nik);
        $nik = str_replace('-', '', $nik);
        $nik = str_replace("\n", '', $nik);
        $nik = str_replace('L', '6', $nik);
        $nik = str_replace('b', '6', $nik);
        $result_nik = $nik;
      }
      if (strpos($line, 'Nama') !== false || strpos($line, 'NAMA') !== false) {
        $nama = str_replace('Nama ', '', $line);
        $nama = str_replace('Nama', '', $nama);
        $nama = str_replace('-', '', $nama);
        $nama = str_replace(':', '', $nama);
        $result_nama = $nama;
      }
    }
    return [
      'NAMA' => $result_nama,
      'NIK' => $result_nik,
    ];
  }
}
