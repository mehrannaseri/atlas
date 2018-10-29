<?php

return [
    'show'        => true,
    'name'        => 'Exhibition',
    'url'         => '#',
    'icon'        => 'eye',
    'label'       => '',
    'label_color' => '',
    'active'      => ['panel/exhibition' , 'panel/exhibition/add' , 'panel/exhibition/edit/*'],

    'submenu'     => [
        [
            'permission' => 'read exhibition',
            'text'       => 'Exhibition list',
            'icon'       => 'list',
            'url'        => 'panel/exhibition',
            'active'     => ['panel/exhibition']
        ],
        [
            'permission' => 'create exhibition',
            'text'       => 'Add Exhibition',
            'icon'       => 'plus',
            'url'        => 'panel/exhibition/add',
            'active'     => ['panel/exhibition/add','panel/exhibition/edit/*'],

        ]
    ]
];

/*
 * all config for menu
 * name => text
 * url => url
 * icon => user
 * icon_color => success
 * label => number - 4
 * label_color = info
 * class = active
 * target = _blank
 * submenu => [
 *      [ text => 'text' , ...],[ ]
 * ]
 * submenu_class
 *
 */
