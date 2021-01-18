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

    $link_name = $_POST["link_name"];
    $link_url = $_POST["link_url"];
    $server_id = $_POST["server_id"];

    $links = new ProLinks();
    $links->id = $server_id;
    $links->channel = $link_name;
    $links->url = $link_url;


    if($links->update()){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث السيرفر بنجاح','b' => false));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
    }

}