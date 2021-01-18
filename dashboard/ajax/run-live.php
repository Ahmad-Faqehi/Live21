<?php
session_start();
include "../includes/Database.php";
include "../includes/functions.php";
include "../includes/require.php";
if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(!isset($_SESSION['_token']) OR !isset($_POST['token']) OR $_POST['token'] != $_SESSION['_token'] OR !isset($_SESSION['dashId:TVTC'])){
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة','b' => true));
    }

    $match_id = $_POST['matchid'];

    $match = new Live();
    if($match->runLive($match_id)){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تشغيل البث بنجاح ','b' => true));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
    }

}