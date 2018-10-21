<?php
/**
 * Created by PhpStorm.
 * User: Kubak
 * Date: 10/17/2018
 * Time: 5:28 PM
 */


function rate($rates){
    $sumrate = 0;
    $star = '';
    foreach($rates as $rate){
        $sumrate += $rate->rate;
    }
    if(sizeof($rates) > 0) {
        $rating = (float) $sumrate / sizeof($rates);
    }
    else {
        $rating = 0;
    }
    return $rating;
    /*$rank = explode('.',$rating);

    $full = $rank[0];
    $half = (isset($rank[1]) ? ceil($rank[1]) : 0);
    $empty = ($half !== 0) ? 5 - ($full+ 1) : 5 - $full;

    for($i = 1 ; $i <= $full ; $i++){
        $star .= '<span class="rating-star full-star"></span>';
    }

    if($half !== 0)
        $star .= '<span class="rating-star half-star"></span>';

    for($i = 1 ; $i <= $empty ; $i++){
        $star .= '<span class="rating-star empty-star"></span>';
    }

    return $star;*/
}

function rate_info($rates){

    return array(rate($rates),sizeof($rates));
}

