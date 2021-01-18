<?php
session_start();
include "../includes/Database.php";
include "../includes/functions.php";
if($_SERVER['REQUEST_METHOD'] == "POST") {


    $email_username = $_POST['email'];
    $password = $_POST['password'];
    $captcha = $_POST['reCAPTCHA'];
    $secretKey = "6LfZSyoaAAAAABXnNruQlnSOMfJqokWgcqhiBFTH";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);

    if(empty($captcha)){
        returnJSON(array('t' => 'خطأ', 'm' => 'الرجاء التحقق انك لست روبوت', 'tp' => 'error', 'b' => true));
    }



    if(!$responseKeys["success"]) {
        returnJSON(array('t' => 'ErR0r', 'm' => 'wHaT tHE hElL yOu wAnt :)', 'tp' => 'error', 'b' => true));

    }

    if (empty($email_username) || empty($password)) {
        returnJSON(array('t' => 'خطأ', 'm' => 'يجب ملء جميع الحقول', 'tp' => 'error', 'b' => true));
    } else {

        if (filter_var($email_username, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("SELECT id, password, Username, Roal FROM users WHERE email=:email_user");
        } else {
            $stmt = $conn->prepare("SELECT id, password, Username, Roal FROM users WHERE username=:email_user");
        }
        $stmt->bindValue(":email_user", $email_username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $id = $row['id'];
            $password = $row['password'];
            $passwordd = password_verify($_POST['password'], $password);

            if ($passwordd) {
                $_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));
                $_SESSION['dashId:TVTC'] = $id;
                $_SESSION['dashName:TVTC'] = $row['Username'];
                $_SESSION['dashRank:TVTC'] = $row['Roal'];
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