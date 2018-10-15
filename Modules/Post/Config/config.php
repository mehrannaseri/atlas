<?php

return [
    'show'        => true,
    'name'        => 'News',
    'url'         => '#',
    'icon'        => 'newspaper-o',
    'label'       => '',
    'label_color' => '',
    'active'      => ['panel/post' , 'panel/post/add'],
    'submenu'     => [
        [
            'text'   => 'Add News',
            'icon'   => 'plus',
            'url'    => 'panel/post/add',
            'active' => ['panel/post/add'],

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
