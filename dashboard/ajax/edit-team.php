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

    $team_name = $_POST["team_name"];
    $team_id = (int)$_POST["team_id"];

    $team = new Equipe();
    $team->fullTeamName = $team_name;
    $row = $team->getById($team_id);

    if ($team_name == $row['fullTeamName'] ){

        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث النادي بنجاح','b' => false));
    }

    if($team->getByTeamName($team_name)){
        returnJSON(array('tp' => 'warning', 't' => 'خطأ', 'm' => 'هذا النادي موجود مسبقاً','b' => true));
    }

    if($team->updateByid($team_id)){
        returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث النادي بنجاح','b' => false));
    }else{
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
    }

}