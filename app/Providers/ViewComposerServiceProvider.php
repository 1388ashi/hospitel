<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use App\Helpers\Helpers;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function boot()
    {
        view()->composer('admin.layouts.master', function ($view) {
            // دریافت اعلان‌ها از دیتابیس
            $notifications = Notification::all();
            $logo = Helpers::setting('logo', asset('images/logo.png'));
            $view->with(compact('notifications','logo'));
        });
    }

    public function register()
    {
        //
    }
}
