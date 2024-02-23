<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DaraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $owner = [
            'name' => 'Sujon',
            'address' => 'Kushtia',
            'phone' => '01779601501',
            'email' => 'bipulhosen95@gmail.com',
        ];
        view()->share(['owner' => $owner]);
    }
}
