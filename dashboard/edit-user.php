<?php

//if(!isset($_GET['do'])): header("Location: index.php"); die(); endif;
//if(isset($_GET['do'])){
//
//    $do = $_GET['do'];
//
//    switch ($do){
//        case 'support':
//            $job = "الدعم الفني";
//            break;
//
//        case 'key':
//            $job = "مسؤولة المفاتيح";
//            break;
//
//        case 'security':
//            $job = "الامن";
//            break;
//
//        case 'doctor':
//            $job = "الطبيبة";
//            break;
//
//        default:
//            $job = "";
//    }
//    if(empty($job)){
//        header("Location: index.php"); die();
//    }
//
//    $lable = " نموذج " . $job;
//}

?>
<?php include "includes/head.php";?>
<?php
$updated = false;
if(!isset($_GET['id'])){exit(header('Location: index.php')); die();}
$userId = (int)$_GET['id'];
if(empty($userId)){exit(header('Location: index.php')); die();}
$stmt=$conn->prepare("SELECT * FROM users WHERE id=:id");
$stmt->bindValue(":id", $userId);
$stmt->execute();
$row = $stmt->fetch();
if($row['roal'] == 4 ){
    $aStudent = true;
}else{
    $aStudent = false;
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


                    <!-- Nav Item - Alerts -->
                    <?php include "includes/alert.php"?>
                    <!-- End of Alert -->

                    <!-- Nav Item - message -->
                    <?php include "includes/msg.php"?>
                    <!-- END - message -->

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
                                <h6 class="m-0 font-weight-bold text-dark Font-tajawal text-center">  تعديل بيانات <?php echo ($aStudent) ? 'الطالب' : "المسؤول" ?>  </h6>
                            </div>
                            <div class="card-body">

                                <?php
                                if(isset($_POST['update'])){
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                       exit("<div class=\"alert alert-danger text-center \"> الائميل غير صحيح </div>");
                                    }

                                    // check if email is alredy used
                                    $stmte=$conn->prepare("SELECT email FROM users where email = :email");
                                    $stmte->bindValue(":email", $email);
                                    $stmte->execute();



                                    if($aStudent){
                                        //Todo Updtet student


                                            if($email == $row['email']):
                                            else:
                                               if($stmte->rowCount() > 0){
                                                   exit("<div class=\"alert alert-danger text-center \"> هذا الائميل مُسجل مسبقاً <a href='' class='btn-link'> عودة </a> </div>");
                                               }
                                            endif;

                                        $stmtu=$conn->prepare("UPDATE `users` SET `name`=:name,`email`=:email WHERE id = :id");
                                        $stmtu->bindValue(":name", $name);
                                        $stmtu->bindValue(":email", $email);
                                        $stmtu->bindValue(":id", $userId);
                                        $stmtu->execute();
                                        if($stmtu->rowCount() > 0){
                                            $updated = true;
                                            echo "<div class=\"alert alert-success text-center\"> تم التحديث بيانات الطالب بنجاح </div>";
                                        }

                                    }else{
                                        //Todo Update one in Depart

                                        $depart = $_POST['dep'];

                                        if($depart == "0"){ exit("<div class=\"alert alert-danger text-center\"> يجب أختيار القسم <a href='' class='btn-link'> عودة </a> </div>"); }

                                        $stmtu=$conn->prepare("UPDATE `users` SET `name`=:name,`email`=:email,roal=:roal WHERE id = :id");
                                        $stmtu->bindValue(":name", $name);
                                        $stmtu->bindValue(":email", $email);
                                        $stmtu->bindValue(":roal", $depart);
                                        $stmtu->bindValue(":id", $userId);
                                        $stmtu->execute();
                                        if($stmtu->rowCount() > 0){
                                            $updated = true;
                                            echo "<div class=\"alert alert-success text-center\"> تم التحديث بيانات المسؤال بنجاح </div>";
                                        }

                                    }
                                }
                                ?>

                                <form action="" method="post" class="text-right">

                                    <label for="username" class="pull-right text-dark">اسم <?php echo ($aStudent) ? 'الطالب' : "المسؤول" ?></label>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control form-control-user"  value="<?php if($updated){ echo $name;}else{  echo $row['name']; }?>" required>
                                    </div>

                                    <label for="username" class="pull-right text-dark">إئميل <?php echo ($aStudent) ? 'الطالب' : "المسؤول" ?></label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" value="<?php if($updated){ echo $email;}else{  echo $row['email']; }?>" required>
                                    </div>

                                    <?php
                                    if(!$aStudent):
                                    ?>
                                    <label for="username" class="pull-right text-dark">القسم</label>
                                    <div class="form-group">
                                        <select class="form-control" name="dep">
                                            <option value="0" id="0">أختار القسم</option>
                                            <option value="2" id="2">الامن</option>
                                            <option value="1" id="1">الدعم الفني</option>
                                            <option value="5" id="5">مسؤولة المفاتيح</option>
                                            <option value="3" id="3" >الطبيبة</option>
                                        </select>
                                    </div>
                                    <?php
                                    endif;
                                    ?>

                                    <input type="submit" name="update" value="تعديل" class="btn btn-dark btn-block">

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


<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<div class="text-left">
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


<!-- Page level custom scripts -->
<script>
    $('#<?php if($updated){ echo $depart;}else{  echo $row['roal']; }?>').attr("selected","selected");
</script>
</body>

</html>
