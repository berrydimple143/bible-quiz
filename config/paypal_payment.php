<?php

return [
    # Define your application mode here
    'mode' => 'live',

    # Account credentials from developer portal
    // Sandbox
    /*'account' => [
        'client_id' => env('PAYPAL_CLIENT_ID', 'AVNMTvdwOU66d81mGc2l7r1pE5d5U6l-inD0-nsszYkGzV9pGYvsRlLBccPH7RaspsSR_IrcsOglwgwO'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', 'EOtB5yQ0fb8cpc9VjFF6nOSuG2P0_DjhuLvl4xmLmXz-s4z41hpxjJ-qHubfTjtj0sU-Csz48nYLv4Y2'),
    ],*/
    // Live
    'account' => [
        'client_id' => env('PAYPAL_CLIENT_ID', 'AYU_Uf_Jk3qRmuzPmnCFTnbRmOKQBVpJTlCBWm-94ssFViBpfms2uDmWtRdvdHHoMRQYy-4eRWxR9AFf'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', 'ENgEZB1lkihzlKu8I4G3VPrG-Gh--GTS3rE1MKQjvufMReiLI3EZrLfQJzxNGV7PMw0GjUDqY5wX9wqp'),
    ],
    
    # Connection Information
    'http' => [
        'connection_time_out' => 30,
        'retry' => 1,
    ],

    # Logging Information
    'log' => [
        'log_enabled' => true,

        # When using a relative path, the log file is created
        # relative to the .php file that is the entry point
        # for this request. You can also provide an absolute
        # path here
        'file_name' => '../PayPal.log',

        # Logging level can be one of FINE, INFO, WARN or ERROR
        # Logging is most verbose in the 'FINE' level and
        # decreases as you proceed towards ERROR
        'log_level' => 'FINE',
    ],
];
