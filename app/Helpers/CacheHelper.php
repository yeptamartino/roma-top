<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Cache;

class CacheHelper {
  private $store = 'redis';

  public function put($key, $value, $expiration = 3600) {    
    Cache::store('redis')->put($this->formatKey($key), $value, $expiration);
  }

  public function get($key) {    
    return Cache::store('redis')->get($this->formatKey($key));
  }

  public function check($key) {
    Cache::store('redis')->get($this->formatKey($key));
  }

  private function formatKey($key) {
    return $key;
  }
}
