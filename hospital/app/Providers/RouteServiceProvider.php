<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->responseMacros();
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    private function responseMacros(): void
    {
        ResponseFactory::macro('success', function ($message, array $data = null, $httpCode = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ], $httpCode);
        });

        ResponseFactory::macro('error', function ($message, array $data = null, $httpCode = 400) {

            //validation error
            if ($httpCode == 422){
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'errors' => $data
                ], $httpCode);

            }
            return response()->json([
                'success' => false,
                'message' => $message,
                'data' => $data
            ] ,$httpCode);

        });
    }
}
