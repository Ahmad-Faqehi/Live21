<?php
session_start();
include "../includes/Database.php";
include "../includes/functions.php";
include "../includes/require.php";
if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(!isset($_SESSION['_token']) OR !isset($_POST['token']) OR $_POST['token'] != $_SESSION['_token'] OR !isset($_SESSION['dashId:TVTC']) OR $_SESSION['dashRank:TVTC'] != "admin"){
        returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ غير معروف من فضلك أعد تحميل هذه الصفحة','b' => true));
    }
// Get values.

    $username = $_POST["username"];
    $email = $_POST["email"];
    $roal = $_POST["roal"];
    $pass = $_POST["password"];
    $user_id = $_POST["user_id"];



    $user = new User();

  $row = $user->getById($user_id);

    if($username != $row['Username']){
        // user change the username so check if new user is available or not.
        if($user->getByUsername($username)){
            returnJSON(array('tp' => 'warning', 't' => 'خطأ', 'm' => 'اسم المستخدم غير متاح. الرجاء اختيار اسم مستخدم اخر','b' => true));
        }
    }

    if($email !== $row['Email']){
        // user change the email so check if new email is available or not.
        if($user->getByEmail($email)){
            returnJSON(array('tp' => 'warning', 't' => 'خطأ', 'm' => 'الائميل غير متاح. الرجاء اختيار أئميل اخر','b' => true));
        }
    }



    $user->Username = $username;
    $user->Roal = $roal;
    $user->Email = $email;






    if(empty($pass)){

        if($user->updateUserById($user_id)){
            returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث بيانات المستخدم بنجاح','b' => false));
        }else{
            returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
        }

    }else{
        $passwordHashed=password_hash($pass, PASSWORD_DEFAULT);
        $user->Password = $passwordHashed;

        if($user->updateUserWithPsssById($user_id)){
            returnJSON(array('tp' => 'success', 't' => 'حسناً', 'm' => 'تم تحديث بيانات المستخدم بنجاح','b' => false));
        }else{
            returnJSON(array('tp' => 'error', 't' => 'خطأ', 'm' => 'حدث خطأ حاول مره أخرى','b' => true));
        }
    }



}