<?php
/**
 * Created by PhpStorm.
 * User: Kubak
 * Date: 10/17/2018
 * Time: 5:28 PM
 */
function sum(){
    return 10;
}

function rate($rates){
    $sumrate = 0;
    foreach($rates as $rate){
        $sumrate += $rate->rate;
    }
    if(sizeof($rates) > 0) {
        $rating = $sumrate / sizeof($rates);
    }
    else{
        $rating = "0.0";
    }
    if(intval($rating)){
        $rating = $rating.".0";
    }
    return $rating;
}