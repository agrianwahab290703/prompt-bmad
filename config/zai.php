<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Z.AI API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Z.AI API integration
    |
    */

    'api_key' => env('ZAI_API_KEY', ''),
    'api_url' => env('ZAI_API_URL', 'https://api.z.ai/v1'),
    'model' => env('ZAI_MODEL', 'glm-4.6'),
    'timeout' => env('ZAI_TIMEOUT', 60),
];
