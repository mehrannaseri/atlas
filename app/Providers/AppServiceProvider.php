<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Nwidart\Modules\Facades\Module;

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
            $event->menu->add('Atlas Panel');

            $list = Module::all();

            $result = implode(",",$list);
            $arr_result = explode("," , $result);

            foreach ($arr_result as $module){

                $menu = config(strtolower($module));
                if(isset($menu['show']) && $menu['show'] === true) {
                    $item = [
                        'text' => $menu['name'],
                        'url' => $menu['url'],
                        'icon' => $menu['icon'],
                        'label' => $menu['label'],
                        'label_color' => $menu['label_color'],
                        'submenu' => (isset($menu['submenu']) ? $menu['submenu'] : [])
                    ];

                    $event->menu->add($item);
                }


            }
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
