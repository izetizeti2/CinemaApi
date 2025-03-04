<?php


return [
    'paths' => ['api/*'], // Lejo vetëm kërkesat API
    'allowed_methods' => ['*'], // Lejo të gjitha metodat (GET, POST, DELETE, etj.)
    'allowed_origins' => ['http://localhost:8080'], // Lejo vetëm Vue frontend-in
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // Nëse përdor cookies për autentikim, vendos "true"
];

