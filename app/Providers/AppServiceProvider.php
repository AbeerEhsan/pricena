<?php

namespace App\Providers;

use App\Services\SocialUserResolver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;


class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public $bindings = [
        SocialUserResolverInterface::class => SocialUserResolver::class,
    ];
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
        //
        Schema::defaultStringLength(191);

    }
}
