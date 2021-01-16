<?php

namespace App\Helpers;
use App\Models\Memory;
use App\Models\Setting;

class ExcelHelper {
  public function generateExcelFileName($table, $keyword, $tgl_awal, $tgl_akhir, $format) {
    $result = strtolower($table);
    if($keyword) {
      $result .= '-' . strtolower($keyword);
    }
    if($tgl_awal) {
      $result .= '-' . strtolower($tgl_awal);
    }
    if($tgl_akhir) {
      $result .= '-' . strtolower($tgl_akhir);
    }
    $result .= '.'.$format;
    return $result;
  }
}
