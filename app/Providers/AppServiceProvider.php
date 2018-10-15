<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('Atlas panel',
                [
                    'text' => 'Blog',
                    'url'  => 'admin/blog',
                    'can'  => 'manage-blog',
                ],
                [
                    'text'        => 'Dashboard',
                    'url'         => 'admin/dashboard',
                    'icon'        => 'file',
                    'label'       => 4,
                    'label_color' => 'success',
                ],
                'ACCOUNT SETTINGS',
                [
                    'text' => 'setting',
                    'url'  => 'admin/settings',
                    'icon' => 'user',
                ],
                [
                    'text' => 'Change Password',
                    'url'  => 'admin/settings',
                    'icon' => 'lock',
                ],
                [
                    'text'    => 'Multilevel',
                    'icon'    => 'share',
                    'submenu' => [
                        [
                            'text' => 'Level One',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level One',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Two',
                                    'url'  => '#',
                                ],
                                [
                                    'text'    => 'Level Two',
                                    'url'     => '#',
                                    'submenu' => [
                                        [
                                            'text' => 'Level Three',
                                            'url'  => '#',
                                        ],
                                        [
                                            'text' => 'Level Three',
                                            'url'  => '#',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'text' => 'Level One',
                            'url'  => '#',
                        ],
                    ],
                ],
                'LABELS',
                [
                    'text'       => 'Important',
                    'icon_color' => 'red',
                ],
                [
                    'text'       => 'Warning',
                    'icon_color' => 'yellow',
                ],
                [
                    'text'       => 'Information',
                    'icon_color' => 'aqua',
                ]
            );

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
