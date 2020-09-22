<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SudoBible Configuration
    |--------------------------------------------------------------------------
    |
    | These configs are used to automatically instatiate an instance of
    | SudoBible in the Service Provider.
    |
    */
    'db_host' => env('SUDOBIBLE_DB_HOST', 'localhost'),
    'db_user' => env('SUDOBIBLE_DB_USER', 'onlinest_virgil'),
    'db_pass' => env('SUDOBIBLE_DB_PASS', 'SophieBerry!4344'),
    'db_name' => env('SUDOBIBLE_DB_NAME', 'onlinest_blogs'),
    'translation' => env('SUDOBIBLE_TRANSLATION', 'KJV'), // optional, can be name, abbr, or id

];
