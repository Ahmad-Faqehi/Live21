<?php
session_start();
include "../includes/Database.php";
include "../includes/functions.php";
include "../includes/require.php";
if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(!isset($_SESSION['_token']) OR !isset($_POST['token']) OR $_POST['token'] != $_SESSION['_token'] OR !isset($_SESSION['dashId:TVTC']) OR $_SESSION['dashRank:TVTC'] != "admin"){
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة','b' => true));
    }
// Get values.

    $ad_code = "";
    $ad_name = $_POST["ad_name"];
    $ad_id = (int)$_POST["ad_id"];
    $ad_type = $_POST["ad_type"];

    $ads = new Ads();
    $ads->id = $ad_id;
    $ads->Ads_Code = $ad_code;
    $ads->Ads_Name = $ad_name;
    $ads->Ads_Work = $ad_type;

    if($ads->update()){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث الاعلان بنجاح','b' => false));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
    }

}