<?php

return [
    'show'        => true,
    'name'        => 'Contact message',
    'url'         => '#',
    'icon'        => 'commenting',
    'label'       => '',
    'label_color' => '',
    'active'      => ['panel/contactus' ],
    'submenu'     => [
        [
            'permission' => 'Show Messages',
            'text'       => 'Messages list',
            'icon'       => 'list',
            'url'        => 'panel/contactus',
            'active'     => ['panel/contactus']
        ],

    ]
];