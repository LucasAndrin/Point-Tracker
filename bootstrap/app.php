<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // health: '/up',
        // web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::prefix('api')->middleware('api')->group(function () {
                /** @var string[] */
                $centralDomains = config('tenancy.central_domains');

                foreach ($centralDomains as $domain) {
                    Route::domain($domain)
                        ->group(base_path('routes/api.php'));
                }

                Route::middleware([
                    InitializeTenancyByDomain::class,
                    PreventAccessFromCentralDomains::class,
                ])->group(base_path('routes/tenant.php'));
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
