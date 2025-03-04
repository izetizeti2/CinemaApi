<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | Database është fshirë, kështu që tani përdorim "file".
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Sesionet do të zgjasin për këtë kohë (në minuta).
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | Mund të aktivizosh enkriptimin e sesioneve nëse është e nevojshme.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | Vendndodhja e sesioneve kur përdoret "file" driver.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Cache Store (Jo e nevojshme)
    |--------------------------------------------------------------------------
    |
    | E hequr sepse nuk përdor më cache për sesionet.
    |
    */

    'store' => null,

    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    |
    | Përqindja e mundësisë që sesionet e vjetra të fshihen.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Emri i cookie për sesionin.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    'path' => env('SESSION_PATH', '/'),

    'domain' => env('SESSION_DOMAIN'),

    'secure' => env('SESSION_SECURE_COOKIE'),

    'http_only' => env('SESSION_HTTP_ONLY', true),

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
