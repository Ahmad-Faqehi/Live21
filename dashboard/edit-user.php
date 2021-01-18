
<?php
if(isset($_GET['id'])):
    $user_id = (int)$_GET['id'];
endif;
if(empty($user_id) OR !is_numeric($user_id))
    exit(header("Location: ads.php"));
?>
<?php

include "includes/head.php";
if ($_SESSION['dashRank:TVTC'] != "admin") {
    exit(header("Location: index.php"));
}
$user = new User();
$row = $user->getById($user_id);
if(!$row){

    exit("<script>location.href = \"./index.php\";</script>");
}
?>
<style>
    .navbar-nav{
        padding-right: 0;
    }
    .input-group>.input-group-append>.btn{
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-top-left-radius: .35rem;
        border-bottom-left-radius: .35rem;
    }

    @media (min-width: 768px){
        .sidebar.toggled .nav-item .nav-link {
            text-align: center;
            padding: .75rem 1rem;
            padding-top: 0.35rem;
            padding-right: 1rem;
            padding-bottom: 0.75rem;
            padding-left: 1rem;
            width: 6.5rem;
        }
    }

    @media (min-width: 635px){
        .topbar .dropdown .dropdown-menu {
            width: auto;
            right: -110px;
        }
    }
    .head-menu{
        font-size: 12px;
    }

    *{
        font-family: 'Tajawal', sans-serif;

    }
</style>
<body id="page-top" >

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include "includes/menu.php" ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link text-dark d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav mr-auto">



                    <!-- Nav Item - Logout and options -->
                    <?php include "includes/logout-menu.php"?>
                    <!-- END  -->

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800 text-right Fonty">لوحة التحكم</h1>

                </div>
                <!-- Content Row -->
                <div class="row" >


                    <div class="col-xl-12 col-md-12 mb-4" dir="rtl">


                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-dark Font-tajawal text-center">  تعديل بيانات المستخدم   </h6>
                            </div>
                            <div class="card-body">

                                <form onsubmit="return false" class="text-right">



                                    <label for="username" class="pull-right text-dark">اسم المستخدم </label>
                                    <div class="form-group">
                                        <input type="hidden" value="<?=$user_id?>" id="user_id">
                                        <input type="text" class="form-control form-control-user" id="username"  value="<?=$row['Username'];?>" required>
                                    </div>

                                    <label for="email" class="pull-right text-dark">الائميل </label>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email"  value="<?=$row['Email'];?>" required>
                                    </div>

                                    <label for="password" class="pull-right text-dark">كلمة المرور الجديدة <small> (أتركه فارغ اذا لاتريد التغير) </small> </label>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" >
                                    </div>

                                    <label for="repassword" class="pull-right text-dark">اعادة كلمة المرور الجديدة <small> (أتركه فارغ اذا لاتريد التغير) </small> </label>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="repassword">
                                    </div>

                                    <label for="select" class="pull-right text-dark">حالة الاعلان</label>
                                    <div class="form-group">
                                        <select class="form-control" name="dep" id="select">
                                            <option value="admin" id="admin">مشرف</option>
                                            <option value="user" id="user">مستخدم</option>

                                        </select>
                                    </div>


                                    <input type="submit"  onclick="update()" value="تعديل" class="btn btn-dark btn-block">

                                </form>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include "includes/footer.php";?>

<script>
    <?php if($row['Roal'] == "user"): ?>  $("#user").attr("selected","selected");  <?php endif; ?>
    <?php if($row['Roal'] == "admin"): ?>  $("#admin").attr("selected","selected");  <?php endif; ?>


</script>

<script>
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    function update() {



        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var roal = document.getElementById("select").value;
        var userId = document.getElementById("user_id").value;
        var password = document.getElementById("password").value;
        var repassword = document.getElementById("repassword").value;
        var token = document.querySelector('meta[name="token"]').content;

        if(password != "" && password !== repassword){

               swal.fire({
                   title: "خطاء",
                   text: "كلمة السر غير متطابقتين",
                   icon: "warning",
                   showConfirmButton: true,
                   confirmButtonText: 'موافق'
               });

        }else if(!validateEmail(email)){

            swal.fire({
                title: "خطاء",
                text: "يجب ان يكتب الائميل بشكل صحيح",
                icon: "warning",
                showConfirmButton: true,
                confirmButtonText: 'موافق'
            });

        }else {

            const Url = "ajax/edit-user.php";
            const data={
                username: username,
                email: email,
                password: password,
                roal: roal,
                token : token,
                user_id: <?=$user_id?>
            }
            $.post(Url,data ,function (response,status) {
                swal.fire({
                    title: response.t,
                    text: response.m,
                    icon: response.tp,
                    showConfirmButton: response.b,
                    confirmButtonText: 'موافق'
                });
                if(response.tp == "success"){
                    setTimeout(function () { location.href = "./users.php";}, 3000);
                }
            })
        }
    }

</script>
</body>

</html>
