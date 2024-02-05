<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\AdminRepositoryInterface',
            'App\Repository\AdminRepository');
      $this->app->bind(  'App\Repository\UserRepositoryInterface',
            'App\Repository\UserRepository');

    $this->app->bind(  'App\Repository\PropertyRepositoryInterface',
            'App\Repository\PropertyRepository');
        $this->app->bind(  'App\Repository\SettingsRepositoryInterface',
            'App\Repository\SettingsRepository');

            $this->app->bind(  'App\Repository\UserTransactionRepositoryInterface',
            'App\Repository\UserTransactionRepository');

        $this->app->bind(  'App\Repository\WithdrawRepositoryInterface',
            'App\Repository\WithdrawRepository');

            $this->app->bind(  'App\Repository\AccountRepositoryInterface',
            'App\Repository\AccountRepository');




        $this->app->bind(  'App\Repository\PaymentRepositoryInterface',
            'App\Repository\PaymentRepository');




        $this->app->bind(  'App\Repository\InvestmentRepositoryInterface',
            'App\Repository\InvestmentRepository');



    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
