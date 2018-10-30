<?php
/**
 * Created by PhpStorm.
 * User: Kubak
 * Date: 10/30/2018
 * Time: 8:38 AM
 */
use Carbon\Carbon;
function ExibStatus($start_holding , $end_holding , $start_reg , $end_reg){
    $main_date = date('Y-m-d');
    $date = date_create($main_date);
    $start = date_diff($date,date_create($start_holding));
    $end = date_diff($date,date_create($end_holding));
    $Sreg = date_diff($date,date_create($start_reg));
    $Ereg = date_diff($date,date_create($end_reg));

    if($main_date < $start_holding && $main_date >= $end_reg){
        $day = $start->format("%R%a");
        $result = '<span class="label-kubak-info">'.$day.' day left to start holding</span>';
    }
    else if($main_date > $start_holding && $main_date < $end_holding){
        $day = $end->format("%R%a");
        $result = '<span class="label-kubak-danger">'.$day.' day left to finish</span>';
    }
    else if($main_date < $start_reg){
        $day = $Sreg->format("%R%a");
        $result = '<span class="label-kubak-info">'.$day.' day to start registration</span>';
    }
    else if($main_date >= $start_reg && $main_date < $end_reg){
        $day = $Ereg->format("%R%a");
        $result = '<span class="label-kubak-danger">'.$day.' day to end registration</span>';
    }
    else if($main_date >= $start_holding && $main_date <= $end_holding){
        $result = '<span class="label-kubak-success">On performing</span>';
    }
    else if($main_date > $end_holding){
        $result = '<span class="label-kubak-default">Finished</span>';
    }


    return $result;
}