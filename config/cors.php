<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Specify paths for API routes

    'allowed_methods' => ['*'], // Allow all HTTP methods

    'allowed_origins' => ['https://techsabrii.com'], // Replace with your allowed domain

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Allow all headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false, // Set to true if using cookies or sessions
];
