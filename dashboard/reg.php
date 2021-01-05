<?php
include "../includes/Database1.php";
session_start();
?>
<!DOCTYPE html>
<html lang="ar">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>تسجيل حساب</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sb-admin-2.css">
<style>
    *{
        font-family: 'Tajawal', sans-serif;

    }
    input[placeholder]{
        text-align: right;
    }
</style>
</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h3 text-gray-900 mb-4 Font-tajawal font-weight-bold ">أهلاَ بعودتك الى لوحة التحكم</h1>
                                </div>
                                <?php
                                $alert_pass = false;
                                $alert_admin = false;
//                                if(isset($_POST['submit'])){
//                                    $email = $_POST["email"];
//                                    $password = $_POST["password"];
//                                    $stm = $conn->prepare("SELECT * FROM `users` WHERE email=:email");
//                                    $stm->bindValue(":email", $email);
//                                    $stm->execute();
//                                    if($stm->rowCount() != 0){
//                                        $row = $stm->fetch();
//                                        $id = $row['id'];
//                                        $roal = $row['roal'];
//                                        $db_password = $row['password'];
//                                        $passwordd = password_verify($password, $db_password);
//
//                                        if($roal != 1){
//                                            $alert_admin = true;
//                                        }elseif (!$passwordd){
//                                            $alert_pass = true;
//                                        }else{
//                                            $_SESSION['dashId:TVTC'] = $id;
//                                            $_SESSION['dashName:TVTC'] = $row['name'];
//                                            exit(header('Location: index.php'));
//                                        }
//
//                                    }else{
//                                        $alert_pass = true;
//                                    }
//
//
//                                }

                                ?>
                                <?php if($alert_pass): ?>
                                <div class="alert alert-danger text-right" role="alert"  >
                                   خطأ! البيانات المدخلة غير صحيحة
                                </div>
                                <?php endif; if ($alert_admin): ?>
                                <div class="alert alert-warning text-right" role="alert"  >
                                    انت غير مسموح لك الوصول الى لوحة التحكم
                                </div>
                                <?php endif; ?>
                                <form onSubmit="return false" class="user" >
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="username" id="username"  placeholder="أسم المستخددم" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="الأئميل" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="كلمة المرور" required>
                                    </div>
                                    <input type="submit"  id="submit" onClick="register()" value="تسجيل" class="btn btn-primary btn-user font-weight-bold Font-tajawal btn-block">
                                </form>
                                <hr>
<!--                                <div class="text-center">-->
<!--                                    <a class="small" href="../forgotpassword.php">نسيت كلمة المرور؟</a>-->
<!--                                </div>-->
<!--                                <div class="text-center">-->
<!--                                    <a class="small" href="register.php">ليس لديك حساب بعد؟ تسجيل جديد</a>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="js/swal.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<script>
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function register() {

        var email=document.getElementById("email").value;
        var password=document.getElementById("password").value;
        var username=document.getElementById("username").value;

        const Url = "ajax/reg.php";
        const data={
            username: username,
            email: email,
            password, password
        }
        $.post(Url,data ,function (response,status) {
            // console.log(response.m);
            swal({
                title: response.t,
                text: response.m,
                type: response.tp,
                showConfirmButton: response.b,
                confirmButtonText: 'موافق'
            });

            if(response.tp == "success"){
                setTimeout(function () { location.href = "./index.php";}, 3000);
            }
        })
    }
</script>

</body>

</html>
