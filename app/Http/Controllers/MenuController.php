<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;

class MenuController extends Controller
{
    public function index()
    {
        $list = Module::all();

        $result = implode(",",$list);
        $arr_result = explode("," , $result);
        foreach ($arr_result as $module){
            $menu = config(strtolower($module));
            echo $menu['name']."<br>";
            if(isset($menu['subMenus'])){
                foreach ($menu['subMenus'] as $submenu){
                    echo "--".$submenu."<br>";
                }
            }
        }


    }
}
