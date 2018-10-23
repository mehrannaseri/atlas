<?php

return [
    'show'    => true,
    'name'    => 'Staff',
    'url'     => '#',
    'icon'    => 'users',
    'active'  => ['panel/staff' , 'panel/staff/add','panel/staff/edit/*','panel/staff/organization','panel/staff/access_level'],
    'submenu' => [
        [
            'permission' => 'read staff',
            'text'       => 'Staff`s list',
            'icon'       => 'list',
            'url'        => 'panel/staff',
            'active'     => ['panel/staff']
        ],
        [
            'permission' => 'create staff',
            'text'       => 'Add staff',
            'icon'       => 'user',
            'url'        => 'panel/staff/add',
            'active'     => ['panel/staff/add','panel/staff/edit/*'],

        ],
        [
            'permission'  => 'access level',
            'text'        => 'Access level management',
            'icon'        => 'level-up',
            'url'         => 'panel/staff/access_level',
            'active'      => ['panel/staff/access_level']
        ],
        [
            'permission' => 'organization',
            'text'       => 'Role management',
            'icon'       => 'sitemap',
            'url'        => 'panel/staff/organization',
            'active'     => ['panel/staff/organization']
        ]
    ]
];
