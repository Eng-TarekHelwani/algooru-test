<?php

namespace App\Factories;

use GuzzleHttp\Client;

class HttpClientFactory
{
    public static function createJsonPlaceholderClient(): Client
    {
        return new Client([
            'base_uri' => config('services.json_placeholder.base_uri'),
        ]);
    }
}
