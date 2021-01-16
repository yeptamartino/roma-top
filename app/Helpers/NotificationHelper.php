<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Setting;
use App\Constants;
use Carbon\Carbon;

class NotificationHelper {
  public function sendMessage($fcm_token, $user_id, $title, $body, $imageUrl, $actionUrl, $navigationKey) {
    $firebaseMessaging = resolve('App\Repositories\FirebaseMessagingRepository');
    $setting = Setting::latest()->first();

    $image = $imageUrl ?? $setting->notification_default_image;

    if($fcm_token) {
      $firebaseMessaging->sendMessage(
        $fcm_token,
        $title,
        $body,
        $image,
        $navigationKey,
      );

      $notification = new Notification([
        'title' => $title,
        'description' => $body,
        'is_read' => false,
        'type' => Constants::$NOTIFICATION_TYPE_SPECIFIC,
        'action_url' => $actionUrl,
        'image' => $image,
        'user_id' => $user_id,
      ]);

      $notification->save();      
    }
  }

  public function sendMessagesToAll($title, $body, $imageUrl, $actionUrl, $navigationKey) {
    $firebaseMessaging = resolve('App\Repositories\FirebaseMessagingRepository');
    $setting = Setting::latest()->first();

    $image = $imageUrl ?? $setting->notification_default_image;

    $userQuery = User::where('role', Constants::$USER_ROLE_CUSTOMER)
    ->whereNotNull('fcm_token');
    $fcm_tokens = $userQuery->pluck('fcm_token')->toArray();
    $ids = $userQuery->pluck('id')->toArray();

    if(count($fcm_tokens) > 0) {
      $firebaseMessaging->sendMessagesToAll(
        $fcm_tokens,
        $title,
        $body,
        $image,
        $navigationKey,
      );
  
      $notifications = [];
      foreach($ids as $id) {
        array_push($notifications, [
          'title' => $title,
          'description' => $body,
          'is_read' => false,
          'type' => Constants::$NOTIFICATION_TYPE_ALL,
          'action_url' => $actionUrl,
          'image' => $image,
          'user_id' => $id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
      }    
      Notification::insert($notifications);  
    }
  }
}
