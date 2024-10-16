<?php

namespace App\Providers;

use App\Contracts\JsonPlaceholderClient;
use App\Contracts\JsonPlaceholderClientInterface;
use App\Factories\HttpClientFactory;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\JwtAuthService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerAuthService();

        $this->registerJsonPlaceholderClient();
    }

    /**
     * Register the Auth Service binding.
     */
    protected function registerAuthService(): void
    {
        $this->app->bind(AuthServiceInterface::class, JwtAuthService::class);
    }

    /**
     * Register the JsonPlaceholderClient with dependency injection.
     */
    protected function registerJsonPlaceholderClient(): void
    {
        $this->app->bind(JsonPlaceholderClientInterface::class, function () {
            $client = HttpClientFactory::createJsonPlaceholderClient();
            return new JsonPlaceholderClient($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerResponseMacros();
    }

    /**
     * Register custom response macros for success and error handling.
     */
    protected function registerResponseMacros(): void
    {
        Response::macro('success', function ($data = [], $message = 'Success', $statusCode = 200) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        });

        Response::macro('error', function ($message = 'Error', $statusCode = 400, $errors = []) {
            return response()->json([
                'status' => 'error',
                'message' => $message,
                'errors' => $errors,
            ], $statusCode);
        });
    }
}
