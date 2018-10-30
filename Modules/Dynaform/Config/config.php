<?php

return [
    'show'        => true,
    'name'        => 'Dynamic Form',
    'url'         => '#',
    'icon'        => 'eye',
    'label'       => '',
    'label_color' => '',
    'active'      => ['panel/Dynaform' , 'panel/Dynaform/add' ],
    'submenu'     => [
        [
            'permission' => 'Show form',
            'text'       => 'Forms list',
            'icon'       => 'list',
            'url'        => 'panel/dynaform',
            'active'     => ['panel/dynaform']
        ],
        [
            'permission' => 'create dynamic form',
            'text'       => 'Add New Form',
            'icon'       => 'plus',
            'url'        => 'panel/dynaform/add',
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
