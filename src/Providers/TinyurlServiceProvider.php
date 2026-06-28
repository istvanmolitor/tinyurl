<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class TinyurlServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->app->make(Router::class)
            ->group(['prefix' => 'api'], __DIR__.'/../routes/api.php');
    }

    public function register(): void
    {
        //
    }
}
