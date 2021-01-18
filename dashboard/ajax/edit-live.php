<?php
session_start();

include "../includes/Database.php";
include "../includes/functions.php";
include "../includes/require.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {


    if(!isset($_SESSION['_token']) OR !isset($_POST['token']) OR $_POST['token'] != $_SESSION['_token'] OR !isset($_SESSION['dashId:TVTC'])){
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة','b' => true));
    }
// Get values.
    $ks_link = $_POST["ks_link"];
    $link1 = $_POST["link1"];
    $link2 = $_POST["link2"];
    $link3 = $_POST["link3"];
    $type1 = $_POST["type1"];
    $type2 = $_POST["type2"];
    $type3 = $_POST["type3"];
    $state_match = $_POST["state_match"];
    $time = $_POST["time"];
    if($type1 === "true"){$type1 = 0;}else{$type1 = 1;}
    if($type2 === "true"){$type2 = 0;}else{$type2 = 1;}
    if($type3 === "true"){$type3 = 0;}else{$type3 = 1;}
    if($state_match === "true"){$state_match = 1;}else{$state_match = 0;}

    $team_host = $_POST["team_host"];
    $team_goust = $_POST["team_goust"];
    $time_type = $_POST["time_type"];
    $ad_center = $_POST["center_ads"];
    $links_id = $_POST["links_id"];
    $match_id = $_POST["match_id"];


    if($time_type == "manual"){
        $time = strtotime($time);
    }


    $link = new Links();
    $match_get = new Live();
    $row = $match_get->getById($match_id);
    $match = new Live();


    // update links
    $link->Link1 = $link1;
    $link->Link2 = $link2;
    $link->Link3 = $link3;
    $link->Type_Link1 = $type1;
    $link->Type_Link2 = $type2;
    $link->Type_Link3 = $type3;

    $link->id = $links_id;


    // update the live
    $match->id = $match_id;
    $match->Custom_Link = $links_id;
    $match->KS_URL = $ks_link;
    $match->GA_URL = null;
    $match->Channel_Name = null;
    $match->Team_Gust = $team_goust;
    $match->Team_Host = $team_host;
    if($time_type == "auto"){
        $match->Time_OFF = $time;
    }else{
        $match->Time_OFF = $row['Time_OFF'];
    }
    $match->Center_Ad = $ad_center;
    $match->State_Match = $state_match;

    if($match->update() &&  $link->update()){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث البث بنجاح','b' => false));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
    }

}