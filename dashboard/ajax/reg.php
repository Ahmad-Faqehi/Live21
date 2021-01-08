<?php
session_start();
include "../includes/functions.php";
include "../../includes/Database1.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {


    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        returnJSON(array('t' => 'خطأ', 'm' => 'الائميل المسجل غير صحيح', 'tp' => 'error', 'b' => true));
    } else {

        $stmtz = $conn->prepare("SELECT email FROM users WHERE email=:email");
        $stmtzu = $conn->prepare("SELECT username FROM users WHERE username=:user");
        $stmtz->bindValue(":email",$email);
        $stmtzu->bindValue(":user",$username);
        $stmtz->execute();
        $stmtzu->execute();
        if ($stmtz->rowCount() !== 0 || $stmtzu->rowCount() !== 0 ) {

            returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'أنت مسجل مسبقاً بهذا الائميل او اسم المستخدم','b' => true));
        }else{

            $passwordHashed=password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO `users` (`Username`, `Email`, `Password`, `Roal`, `Time_Registered`) VALUES (:usernmae,:email,:pass,:roal,:time_reg )");
        $stmt->bindValue(":usernmae", $username);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":pass", $passwordHashed);
        $stmt->bindValue(":roal", "user");
        $stmt->bindValue(":time_reg", time());
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $MID = $conn->lastInsertId();
            $_SESSION['dashId:TVTC'] = $MID;
            $_SESSION['dashName:TVTC'] = $username;
            returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تسجيل حسابك بنجاح','b' => false));

        } else {

            returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف','b' => true));

        }
    }
    }

    }