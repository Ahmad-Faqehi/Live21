<?php
include "includes/head.php";
include "includes/Database.php";

if(isset($_GET['order'])){
    $stm = $conn->prepare("SELECT * FROM `order` WHERE reared = 0");
    $stm->execute();
    $count = $stm->rowCount();
    if($count > 0){
        $stmtup = $conn->prepare("UPDATE `order` SET reared = 1 WHERE reared = 0");
        $stmtup->execute();
        header("Location: index.php");
        die();
    }else{
        header("Location: index.php");
    }
}elseif (isset($_GET['msg'])){

    $stm = $conn->prepare("SELECT * FROM `contact` WHERE reared = 0");
    $stm->execute();
    $count = $stm->rowCount();
    if($count > 0){
        $stmtup = $conn->prepare("UPDATE `contact` SET reared = 1 WHERE reared = 0");
        $stmtup->execute();
        header("Location: index.php");
        die();
    }else{
        header("Location: index.php");
    }

}else{
    header("Location: index.php");
}
