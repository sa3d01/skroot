<?php

namespace App\Providers;

use App\Models\PasswordReset;
use App\Models\PhoneVerificationCode;
use App\Observers\PasswordResetObserver;
use App\Observers\PhoneVerificationCodeObserver;
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

        //EmailVerificationCode::observe(EmailVerificationCodeObserver::class);
        PhoneVerificationCode::observe(PhoneVerificationCodeObserver::class);
        PasswordReset::observe(PasswordResetObserver::class);
    }
}
