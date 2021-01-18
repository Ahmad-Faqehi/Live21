<?php
session_start();
include "../includes/Database.php";
include "../includes/functions.php";
include "../includes/require.php";
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!isset($_SESSION['_token']) OR !isset($_POST['token']) OR $_POST['token'] != $_SESSION['_token'] OR !isset($_SESSION['dashId:TVTC'])){
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة','b' => true));
    }
    $team_id = $_POST['id'];

    $team = new Equipe();
    if($team->deleteById($team_id)){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم حذف النادي','b' => false));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
    }

}