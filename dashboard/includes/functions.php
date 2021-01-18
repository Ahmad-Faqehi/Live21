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
global $teams;

$host = $teams->getById($host_id)["fullTeamName"];
$goust = $teams->getById($goust_id)["fullTeamName"];

return "{$host} x {$goust}";
}


function checkCenterAd($id){
    if($id == 0){
        return "<span class='text-muted'>غير فعال</span>";
    } else{
    return "<span class='text-dark'>فعال <i class=\"far fa-check-circle text-success\"></i></span>";
    }

}

function getState($id){
    $state= "";
    switch ($id){
        case 0:
            $state = "<span class='text-muted'>غير فعال</span>";
            break;

        case 1:
            $state = "<span class='text-dark'>فعال <i class=\"far fa-check-circle text-success\"></i></span>";
            break;


        default:
            $state = "";


    }
    return $state;
}

    function getMainLink($links){

    $main = "";

    if(!empty($links["Link1"])){

        $main = $links["Link1"];

    }elseif (!empty($links["Link2"])){

        $main = $links["Link2"];

    }elseif (!empty($links["Link3"])){
        $main = $links["Link3"];
    }

    return $main;
    }

    function getLinksFromKS($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $html = new simple_html_dom();
        $html->load($response);

        $urls = array();
        $i = 0;
        foreach($html->find("iframe") as $link){

            if (!strpos($link,'table') !== false and  !strpos($link,'match-card.php') !== false and !strpos($link,'Eh2MnXJa2Bc') !== false) {
                if(strpos($link,"twitch")){
                    $urls["twitch"] = $link->src ;
                }else{
                    $urls[$i] = $link->src ;
                    $i++;
                }

            }

        }

        return $urls;


    }

    function dealWithTwitch($twitch_url,$ks_url){

$newS = str_replace("&amp;","&",$twitch_url);

        $url = $ks_url;
        $parse = parse_url($url);

$newS = str_replace($parse['host'], $_SERVER['HTTP_HOST'],$newS);

return $newS;
    }

function convertToArabic($day){

    $days = array(

        'ألاحد' => "Sunday",
        'ألاثنين' => "Monday",
        'الثلاثاء' => "Tuesday",
        'ألاربعاء' => "Wednesday",
        'الخميس' => "Thursday",
        'الجمعة' => "Friday",
        'السبت' => "Saturday"
    );
    return array_search($day,$days);
}
?>