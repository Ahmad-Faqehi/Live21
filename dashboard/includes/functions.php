<?php

function returnJSON(array $f) {
    /*
        Usage:
        returnJSON(array(params));
    */
    if(!is_array($f)){ exit; }

    header('Content-Type: application/json');

    exit(json_encode($f));

}

function generateNewString($len = 10){
    $token = "pOiuZtrEWQasDfGhjklmnBvCxy1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0, $len);

    return $token;
}

// TODO get the teams names. Must return string 'TEAM1 vs TEAM2'
function getTeamsNames($host_id, $goust_id){
global $team;

$host = $team->getById($host_id)["fullTeamName"];
$goust = $team->getById($goust_id)["fullTeamName"];
$tems = [$host,$goust];
return "{$host} x {$goust}";
}

function getSelected(){



}
function checkCenterAd($id){
    if($id == 0){
        return "<span class='text-muted'>غير فعال</span>";
    } else{
    return "<span class='text-dark'>فعال <i class=\"far fa-check-circle text-success\"></i></span>";
    }

}

?>