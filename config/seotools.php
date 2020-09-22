<?php

return [
    'meta' => [
        'defaults'       => [
            'title'        => '', 
            'titleBefore'  => false, 
            'description'  => '', 
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => true, 
            'robots'       => false, 
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => '', 
            'description' => '', 
            'url'         => false, 
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card'        => 'summary',
            'site'        => '@Virgil_Dimple',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => '', 
            'description' => '', 
            'url'         => false, 
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
