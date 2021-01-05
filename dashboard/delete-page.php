<?php
if(isset($_GET['type'])) {

    $type = $_GET['type'];
    if(!isset($_GET['id'])){header("Location: index.php");die();}
    $id = (int)$_GET['id'];


    if ($type == "img" || $type == "lost" || $type == "list") {

        include "includes/head.php";

        if($type == "img"){
            //Todo update lost table and make image = null
            $stmtz = $conn->prepare("UPDATE `lost` SET `image` = :img WHERE id = :id ");
            $stmtz->bindValue(":img", "");
            $stmtz->bindValue(":id", $id);
            $stmtz->execute();
            if ($stmtz->rowCount() > 0) {
                $_SESSION['alert:img'] = 1;
                header("Location: edit-lost.php?id=$id");

            }else{
                $_SESSION['alert:false'] = 1;
                header("Location: edit-lost.php?id=$id");
            }
        }elseif($type == "lost"){
            //Todo delete recode from table lost

            $stmtz = $conn->prepare("DELETE FROM `lost` WHERE  id = :id ");
            $stmtz->bindValue(":id", $id);
            $stmtz->execute();
            if ($stmtz->rowCount() > 0) {
                $_SESSION['alert:true'] = 1;
                header("Location: loss.php");
            }else{
                $_SESSION['alert:false'] = 1;
                header("Location: loss.php");
            }
        }elseif ($type == "list"){

            $stmtz = $conn->prepare("DELETE FROM `info_list` WHERE  id = :id ");
            $stmtz->bindValue(":id", $id);
            $stmtz->execute();
            if ($stmtz->rowCount() > 0) {
                $_SESSION['alert:true'] = 1;
                header("Location: list.php");
            }else{
                $_SESSION['alert:false'] = 1;
                header("Location: list.php");
            }

        }

    }else{
        header("Location: index.php");
        die();
    }
}