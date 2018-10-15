<?php

return [
    'name'        => 'News',
    'url'         => '#',
    'icon'        => 'newspaper-o',
    'label'       => '',
    'label_color' => '',
    'active'      => ['news' , 'news/add'],
    'submenu'     => [
        [
            'text'   => 'Add News',
            'icon'   => 'plus',
            'url'    => 'admin/news/add',
            'active' => ['news/add'],

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
