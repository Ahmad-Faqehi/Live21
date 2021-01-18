<?php
include "dashboard/includes/require.php";
include "dashboard/includes/functions.php";

$match = new Live();
$match_on =  $match->getMatchesOn();
$time_now = time();

if(!empty($match_on)):

    foreach ($match_on as $val):
        if($time_now >= $val['Time_OFF']){
            // Stop that match
            $match->stopLive($val['id']);
        }
    endforeach;

    endif;
