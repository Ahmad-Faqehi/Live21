<?php
include "Database.php";
include "require.php";
include "functions.php";
session_start();
if(isset($_SESSION['dashId:TVTC'])){
$isLogin = true;
}else{
    exit(header('Location: login.php'));
    die();
}
if(!isset($page_title)){
    $page_title = "Live21";
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="token" content="<?php if(isset($_SESSION['_token'])) { echo $_SESSION['_token']; } ?>">

    <title> التحكم -  <?=$page_title?></title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sb-admin-2.css">

    <!-- Time -->
    <link rel="stylesheet" href="lib/flatpickr.css">
    <link rel="stylesheet" href="lib/dark.css">

    <!-- sweet alert -->
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <?php if($page_title == "الصفحة الرئيسية" ): ?>
    <link rel="stylesheet" href="css/checkSwitch.css">
    <?php endif; ?>

    <?php if($page_title == "أضافة مباراة" || $page_title == "تعديل مباراة"): ?>
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/checkSwitch.css">
        <link rel="stylesheet" type="text/css" href="css/DateTimePicker.css" />
    <?php endif; ?>

    <style>
        *{
            font-family: 'Tajawal', sans-serif;

        }
    </style>
</head>