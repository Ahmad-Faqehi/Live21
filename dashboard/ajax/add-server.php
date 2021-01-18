<?php
session_start();
include "../includes/Database.php";
include "../includes/functions.php";
include "../includes/require.php";


if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!isset($_SESSION['_token']) OR !isset($_POST['token']) OR $_POST['token'] != $_SESSION['_token'] OR !isset($_SESSION['dashId:TVTC'])){
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة','b' => true));
    }
    $server_name = $_POST['link_name'];
    $link_url = $_POST['link_url'];


    $link = new ProLinks();
    $link->channel = $server_name;
    $link->url = $link_url;

    if($link->create()){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم الاضافة','b' => false));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
    }

}
