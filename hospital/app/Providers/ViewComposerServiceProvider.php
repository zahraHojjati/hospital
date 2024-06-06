<?php

namespace App\Providers;

use App\Helpers\Helpers;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }


    public function boot(): void
    {
        view()->composer('admin.layouts.master-admin', function ($view) {

            // دریافت اعلان‌ها از دیتابیس
            $notifications = Notification::all();
            $logo = Helpers::setting('logo');
            $view->with(compact('notifications','logo'));
        });
    }
}
