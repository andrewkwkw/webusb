<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer(['components.front.navbar', 'components.front.footer'], function ($view) {
            $contactData = \Illuminate\Support\Facades\Cache::rememberForever('contact_setting', function () {
                $data = \App\Models\ContactSetting::first();
                return $data ? $data->toArray() : [];
            });
            $contact = (object) $contactData;
            
            $profileData = \Illuminate\Support\Facades\Cache::rememberForever('company_profile', function () {
                $data = \App\Models\CompanyProfile::first();
                return $data ? $data->toArray() : [];
            });
            $profile = (object) $profileData;

            $view->with('contact', $contact);
            $view->with('profile', $profile);
        });
    }
}
