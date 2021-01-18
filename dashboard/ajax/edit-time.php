<?php

session_start();
include "../includes/Database.php";
include "../includes/functions.php";
include "../includes/require.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!isset($_SESSION['_token']) OR !isset($_POST['token']) OR $_POST['token'] != $_SESSION['_token'] OR !isset($_SESSION['dashId:TVTC'])) {
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة', 'b' => true));
    }

    $id = $_POST["match_id"];
    $time = $_POST["time"];
    $time_now = time();
    $human_time = date('h:i A', $time);

    $match = new Live();
    $match->Time_OFF =  $time;

    if($match->updateTimeById($id)){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث وقت أنتهاء المبارة الى ' . $human_time ,'b' => true));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ عند تحديث الوقت الرجاء محاولة مره اخرى', 'b' => true));
    }



}