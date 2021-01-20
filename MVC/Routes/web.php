<?php
    $routes_web = [
        'error-page' => 'Source/Home/notFound',
        'login-page' => 'Source/Home/loginPage/',
        'home' => 'Source/Home/homePage/',
        'register' => 'Source/Home/registerPage',
        'register/email' => 'Source/Home/registerPageEmail'
    ];


    define('WEB_URL', $routes_web);