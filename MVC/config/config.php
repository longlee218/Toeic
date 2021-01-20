<?php
    define("DB_HOST","localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "long");
    define("DB_DATABASE", "quiz_sys_ver3");
    define("TIME_LIFE_COOKIE", 3600);

    define("GOOGLE_ACCESS", array(
            'client_id' => '396392212728-tbvl2u3dj343ibmr5rsrqlc92ukuq06l.apps.googleusercontent.com',
            'client_secret' => 'dphIMyvSqB53kNcoJdl0mPhI',
            'redirect_url' => 'http://localhost/Toeic/api/google/auth'
    ));
    define("REDIRECT_URL", 'http://localhost/Toeic/api/google/auth');