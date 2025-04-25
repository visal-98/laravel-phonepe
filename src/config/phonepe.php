<?php

return [
    'client_id' => env('PHONEPE_CLIENT_ID'),
    'client_secret' => env('PHONEPE_CLIENT_SECRET'),
    'client_version' => env('PHONEPE_CLIENT_VERSION'),
    'base_url' => env('PHONEPE_BASE_URL', 'https://api-preprod.phonepe.com'),
    'redirect_success' => '/payment/success',
    'redirect_failure' => '/payment/failure',
];
