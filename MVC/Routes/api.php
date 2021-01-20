<?php

    $routes_api = [
        'api/login' =>  'API/APILogin/loginBasic/',
        'api/logout' => 'API/APILogin/logout/',
        'api/google/auth' => 'API/APILogin/urlGoogle',
        'api/register' => 'API/APIRegister/register',
    ];

    define('API_URL', $routes_api);
