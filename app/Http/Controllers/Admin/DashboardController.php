<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Constants;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\User;
use App\Models\Setting;
use Flash;
class DashboardController extends Controller
{
    public function dashboard(){
        
        $user_count = User::orderBy('created_at', 'desc')
        ->where('role', Constants::$USER_ROLE_ADMIN)
        ->count();
        
        $users = User::orderBy('created_at', 'desc')
        ->where('role', Constants::$USER_ROLE_ADMIN)
        ->limit(10)->get();

        $setting = Setting::all();
        $catalog_count  = Catalog::count();
        $category_count = Category::count();
        $stock_count    = Category::count();

        return view(
          'admin.dashboard',
           compact(
            'users',
            'user_count',
            'category_count',
            'catalog_count',
            'stock_count',
          ));
    }
   
}
