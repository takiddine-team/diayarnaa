<?php

namespace App\Providers;

use App\Models\BackgroundImage;
use App\Models\ContactUs;
use App\Models\DiyarnaaCountry;
use App\Models\Mail;
use App\Models\MainCategory;
use App\Models\PublicCountry;
use App\Models\PublicCurrency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $background_image = BackgroundImage::first();

            $public_countries = PublicCountry::get();
            $categories = MainCategory::where('status', 1)->get();
            $public_currencies = PublicCurrency::get();
            $contact_us = ContactUs::first();
            $diyarnaa_countries = DiyarnaaCountry::where('status', 1)->get();
            if (Auth::guard('user')->check()) {
                $mails_not_read_count=  Mail::where([
                    ['receiver_id', auth()->guard('user')->user()->id],
                    ['receiver_type', 2],
                    ['deleter_type', 1],
                    ['is_read', 2],
                ])->orWhere([
                    ['receiver_id', auth()->guard('user')->user()->id],
                    ['receiver_type', 2],
                    ['deleter_type', null],
                    ['is_read', 2],
                ])->orderBy('id', 'DESC')->count();
            } else {
                $mails_not_read_count = 0;
            }


            
         

            
            view()->share([
                'background_image' => $background_image,
                'mails_not_read_count' => $mails_not_read_count,
                'public_countries' => $public_countries,
                'categories' => $categories,
                'public_currencies' => $public_currencies,
                'diyarnaa_countries' => $diyarnaa_countries,
                'contact_us' => $contact_us,

            ]);
        });
    }
}
