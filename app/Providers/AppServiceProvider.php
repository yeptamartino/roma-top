<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      if(config('app.env') === 'production' || config('app.env') === 'development') {
        \URL::forceScheme('https');
      }
      Schema::defaultStringLength(191);
      Blade::directive('rupiah', function ($number) {       
        return "<?php echo 'Rp.  ' . number_format($number,0,',','.'); ?>";
      });
    }
}
