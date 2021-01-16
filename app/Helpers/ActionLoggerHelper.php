<?php

namespace App\Helpers;

use App\Models\ActionLogger;
use Illuminate\Support\Facades\Auth;

class ActionLoggerHelper {
  public function logAction($name, $payload = []) {
    $action = ActionLogger::create([
      'name' => $name,
      'payload' => json_encode($payload),
      'user_id' => Auth::user()->id,
    ]);
    $action->save();
  }
}
