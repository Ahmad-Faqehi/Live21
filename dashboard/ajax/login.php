<?php
session_start();
include "../includes/functions.php";
include "../../includes/Database1.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {


    $email_username = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email_username) || empty($password)) {
        returnJSON(array('t' => 'خطأ', 'm' => 'يجب ملء جميع الحقول', 'tp' => 'error', 'b' => true));

    } else {

        if (filter_var($email_username, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("SELECT id, password, Username FROM users WHERE email=:email_user");
        } else {
            $stmt = $conn->prepare("SELECT id, password, Username FROM users WHERE username=:email_user");
        }
        $stmt->bindValue(":email_user", $email_username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $id = $row['id'];
            $password = $row['password'];
            $passwordd = password_verify($_POST['password'], $password);

            if ($passwordd) {
                $_SESSION['dashId:TVTC'] = $id;
                $_SESSION['dashName:TVTC'] = $row['Username'];
                returnJSON(array('t' => 'حسناً', 'm' => 'تم تسجيل الدخول بنجاح', 'tp' => 'success', 'b' => false));
            } else {
                returnJSON(array('t' => 'خطأ', 'm' => 'تفاصيل تسجيل الدخول الخاصة بك خاطئة ، حاول مرة أخرى', 'tp' => 'error', 'b' => true));
            }

        } else {

            returnJSON(array('t' => 'خطأ', 'm' => 'تفاصيل تسجيل الدخول الخاصة بك خاطئة ، حاول مرة أخرى', 'tp' => 'error', 'b' => true));

        }

//        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة','b' => true));

    }
}