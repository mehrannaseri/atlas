<?php

return [
    'show'        => true,
    'name'        => 'Exhibition',
    'url'         => '#',
    'icon'        => 'eye',
    'label'       => '',
    'label_color' => '',
    'active'      => ['panel/fair' , 'panel/fair/add' , 'panel/fair/edit/*'],

    'submenu'     => [
        [
            'permission' => 'read fair',
            'text'       => 'Exhibition list',
            'icon'       => 'list',
            'url'        => 'panel/fair',
            'active'     => ['panel/fair']
        ],
        [
            'permission' => 'create fair',
            'text'       => 'Add Exhibition',
            'icon'       => 'plus',
            'url'        => 'panel/fair/add',
            'active'     => ['panel/fair/add','panel/fair/edit/*'],

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
