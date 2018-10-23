<?php

return [
    'show'        => true,
    'name'        => 'News',
    'url'         => '#',
    'icon'        => 'newspaper-o',
    'label'       => '',
    'label_color' => '',
    'active'      => ['panel/post' , 'panel/post/add' , 'panel/post/category' , 'panel/post/tags','panel/post/edit/*'],

    'submenu'     => [
        [
            'permission' => 'create post',
            'text'  => 'News list',
            'icon'  => 'list',
            'url'   => 'panel/post',
            'active'=> ['panel/post']
        ],
        [
            'permission' => 'add post',
            'text'   => 'Add News',
            'icon'   => 'plus',
            'url'    => 'panel/post/add',
            'active' => ['panel/post/add','panel/post/edit/*'],

        ],
        [
            'permission' => 'read category',
            'text'  => 'Categories Management',
            'icon'  => 'filter',
            'url'   => 'panel/post/category',
            'active'=> ['panel/post/category']
        ],
        [
            'permission' => 'read tag',
            'text'  => 'Tags Management',
            'icon'  => 'tags',
            'url'   => 'panel/post/tags',
            'active'=> ['panel/post/tags'],
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
