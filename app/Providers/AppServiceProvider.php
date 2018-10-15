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
        date_default_timezone_set('Asia/Tehran');

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('Atlas Panel');

            $event->menu->add([
                'text'  => 'Dashboard',
                'url'   => 'panel',
                'icon'  => 'dashboard',
                'active'=> ['panel'],

            ]);

            $list = Module::all();

            $result = implode(",",$list);
            $arr_result = explode("," , $result);

            foreach ($arr_result as $module){

                $menu = config(strtolower($module));
                if(isset($menu['show']) && $menu['show'] === true) {
                    if(isset($menu['submenu'])) {
                        $item = [
                            'text' => $menu['name'],
                            'url' => $menu['url'],
                            'icon' => (isset($menu['icon']) ? $menu['icon'] : ''),
                            'icon_color' => (isset($menu['icon_color']) ? $menu['icon_color'] : ''),
                            'label' => (isset($menu['label']) ? $menu['label'] : ''),
                            'label_color' => (isset($menu['label_color']) ? $menu['label_color'] : ''),
                            'target' => (isset($menu['target']) ? $menu['target'] : ''),
                            'active' => (isset($menu['active']) ? $menu['active'] : ''),
                            'submenu' => (isset($menu['submenu']) ? $menu['submenu'] : array())
                        ];
                    }
                    else{
                        $item = [
                            'text' => $menu['name'],
                            'url' => $menu['url'],
                            'icon' => (isset($menu['icon']) ? $menu['icon'] : ''),
                            'icon_color' => (isset($menu['icon_color']) ? $menu['icon_color'] : ''),
                            'label' => (isset($menu['label']) ? $menu['label'] : ''),
                            'label_color' => (isset($menu['label_color']) ? $menu['label_color'] : ''),
                            'target' => (isset($menu['target']) ? $menu['target'] : ''),
                            'active' => (isset($menu['active']) ? $menu['active'] : '')
                        ];
                    }

                    $event->menu->add($item);
                }
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
