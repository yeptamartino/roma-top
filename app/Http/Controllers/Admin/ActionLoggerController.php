<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActionLogger;
use App\Models\User;
use App\Constants;

class ActionLoggerController extends Controller {

  public function index(Request $request) {
  $keyword = $request->input('keyword');  
  $tgl_awal = $request->get('tgl_awal');
  $tgl_akhir = $request->get('tgl_akhir');    
  $event_filter = $request->get('event_filter');
  $event_count = 0;

  $events = [
    'UPDATE_SETTING',
    'ADD_WINNER',
    'DELETE_WINNER',
    'SEND_NOTIFICATION',
    'DELETE_NOTIFICATION',
    'STORE_OUTLET',
    'UPDATE_OUTLET',
    'DELETE_OUTLET',
    'DELETE_SCAN',
    'DELETE_CUSTOMER',
    'VERIFY_KTP_USER',
    'UNVERIFY_KTP_USER',
    'DOWNLOAD_USER_DATA',
    'STORE_CITY',
    'STORE_POST',
    'UPDATE_CITY',
    'DELETE_CITY',
    'BUSINESS_SUBMISSION_SEND_NOTIFICATION',
    'DOWNLOAD_QR_CODE_OUTLET',
  ];

  $logs = ActionLogger::select('users.name', 'action_loggers.*')
    ->join('users', 'users.id', '=', 'action_loggers.user_id')
    ->orderBy('action_loggers.created_at','desc');

  if ($tgl_awal &&  $tgl_akhir){
    $logs = $logs->whereBetween('action_loggers.created_at', [$tgl_awal, $tgl_akhir]);
  }

  if($keyword) {
    $logs = $logs->where(function ($query) use ($keyword){
        $query->orWhere('users.name','LIKE',"%$keyword%");
        $query->orWhere('action_loggers.name','LIKE',"%$keyword%");
    });
  } 

  if(in_array($event_filter, $events)) {
    $logs = $logs->where('action_loggers.name', $event_filter);
  }

  $logs = $logs->paginate(Constants::$DEFAULT_PAGINATION_COUNT);

  return view('admin.logs.index', compact('logs', 'events', 'event_count'));
}

    public function show($id) {
      $log = ActionLogger::findOrFail($id);
      return view('admin.logs.detail', compact('log'));
    }

}
