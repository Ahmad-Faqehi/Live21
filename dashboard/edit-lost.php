
<?php include "includes/head.php";?>
<?php

if(isset($_GET['id'])){

    if(!is_numeric($_GET['id']) || empty($_GET['id'])){  exit(header('Location: index.php')); die();}

    $lost_id = (int)$_GET["id"];


}else{
    exit(header('Location: index.php')); die();
}

$tag = "<p class='text-danger text-center' > عذرا حصل خطا!!  <br> <a href='index.php' class=' btn btn-link text-center '> عودة </a> </p>";
$stmt= $conn->prepare("SELECT * FROM `lost` WHERE id =:id");
$stmt->bindValue(":id", $lost_id);
$stmt->execute();
$row = $stmt->fetch();







$msg_false = false;
$msg_secss = false;
$msg_img = false;

if(isset($_SESSION['alert:false'])){
    $msg_false = true;
    unset($_SESSION['alert:false']);
}
if (isset($_SESSION['alert:scs'])){
    $msg_secss = true;
    unset($_SESSION['alert:scs']);
}
if (isset($_SESSION['alert:img'])){
    $msg_img = true;
    unset($_SESSION['alert:img']);
}

if(isset($_POST['upload']))
{

    require_once "../vendor/autoload.php";
    \Tinify\setKey("Kw6VngmD7JVw5fBzdn8kGrlBMqWzwgMq");

    $title =  $_POST['loss-name'];
    $description =  $_POST['description'];
    $Image = $_FILES['pictures']['name'];
    $Type = $_FILES['pictures']['type'];
    $Temp = $_FILES['pictures']['tmp_name'];
    $size = $_FILES['pictures']['size'];
    $check = @$_POST['state'];

    if(empty($check)){
        $sate = 0;

    }else{
        $sate = 1;
    }

if (!empty($Image)) {

    $ImageExt = explode('.', $Image);
    $ImgCorrectExt = strtolower(end($ImageExt));
    $Allow = array('jpg', 'jpeg', 'png');
    $Allow2 = array('image/jpg', 'image/jpeg', 'image/png');
    $photoname = time() . "-" . $Image;
    $target = "../img/lost/" . $photoname;
    $realType = mime_content_type($Temp);

    if (!in_array($realType, $Allow2)) {

        echo '<div class="alert alert-danger" role="alert">
        File Not Allow 😒 !! <a href="" class="btn btn-link">Back</a>
      </div>';
        die();
    }


    if (in_array($ImgCorrectExt, $Allow)) {
        if ($size < 10000000) {
            $source = \Tinify\fromFile($Temp);
            $imgless = $source->toFile($target);

            list($width, $height) = getimagesize($target);

            $stmtz = $conn->prepare("UPDATE `lost` SET `title`=:title,`description`=:description,`state`=:state, `image` = :img WHERE id = :id ");
            $stmtz->bindValue(":title", $title);
            $stmtz->bindValue(":description", $description);
            $stmtz->bindValue(":state", $sate);
            $stmtz->bindValue(":img", $photoname);
            $stmtz->bindValue(":id", $lost_id);
            $stmtz->execute();
            if ($stmtz->rowCount() > 0) {
                $_SESSION['alert:scs'] = 1;
                header("Location: edit-lost.php?id=$lost_id");

            } else {
                $_SESSION['alert:false'] = 1;
                header("Location: edit-lost.php?id=$lost_id");

            }

        } else {
            $msg = '<div class="alert alert-warning" role="alert">
                File size Too Large !!
              </div>';
        }
    } else {
        $_SESSION['alert:false'] = 1;
        header("Location: edit-lost.php?id=$lost_id");

    }

}else{

    $stmtz = $conn->prepare("UPDATE `lost` SET `title`=:title,`description`=:description,`state`=:state WHERE id = :id ");
    $stmtz->bindValue(":title", $title);
    $stmtz->bindValue(":description", $description);
    $stmtz->bindValue(":state", $sate);
    $stmtz->bindValue(":id", $lost_id);
    $stmtz->execute();
    if ($stmtz->rowCount() > 0) {
        $_SESSION['alert:scs'] = 1;
        header("Location: edit-lost.php?id=$lost_id");


    } else {
        $_SESSION['alert:false'] = 1;
        header("Location: edit-lost.php?id=$lost_id");

    }

}

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
    img{
        width: 120px;
        height: 120px;
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
                                <h5 class="m-0 font-weight-bold text-dark Font-tajawal text-center">  تعديل على مفقود </h5>
                            </div>
                            <div class="card-body">

                                <?php
                                if($stmt->rowCount() == 0){
                                    die($tag);
                                }
                                ?>

                                <?php if($msg_false): ?>
                                    <div class="alert alert-danger text-right" role="alert"> عذراً حدث خطا غير متوقع. حاول مرة أخرى </div>
                                <?php endif; ?>
                                <?php if($msg_secss): ?>
                                    <div class="alert alert-success text-right" role="alert"> تم التحديث بنجاح </div>
                                <?php endif; ?>
                                <?php if($msg_img): ?>
                                    <div class="alert alert-warning text-right" role="alert"> تم حذف الصورة </div>
                                <?php endif; ?>
                                <form action="" method="post" class="text-right" enctype="multipart/form-data">

                                    <label for="username" class="pull-right text-dark">أسم المفقود</label>
                                    <div class="form-group">
                                        <input type="text" name="loss-name" class="form-control form-control-user" value="<?=$row['title']?>" required placeholder="مثال: جوال ايفون7 , بطاقة صرافة... ">
                                    </div>

                                    <label for="email" class="pull-right text-dark">صورة المفقود</label>
                                    <div class="form-group">
                                        <?php
                                        if(!empty($row['image'])):
                                        ?>
                                            <img src="../img/lost/<?=$row['image']?>" class="  img-fluid pb-1">
                                        <p><a href="#" class="btn-link"  data-toggle="modal" data-target="#delete-photo">حذف الصورة</a> </p>
                                        <?php
                                        endif;
                                        ?>
                                        <input type="file" name="pictures" class="form-control form-control-user"  accept="image/*"  >
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="pull-right text-dark">التفاصيل  <small>(أختياري)</small></label>
                                        <textarea class=" form-control form-input" placeholder="أكتب التفاصيل هنا..." cols="50" rows="10" name="description" autocomplete="off"><?php if(!empty($row['description'])){echo $row['description']; } ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for=""> تم العثور </label>
                                        <input type="checkbox" name="state" value="1" <?php if($row['state']){ echo "checked";} ?> >
                                    </div>

                                    <input type="submit" name="upload" value="تعديل" class="btn btn-dark btn-block">
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

<div id="delete-photo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-white"> </h4>
            </div>
            <div class="modal-body" style="font-size: 16px;">
                <div class="text-center">
                <p class="text-justify text-dark text-center">
                    متاكد من حذف الصورة؟
                </p>
                <a href="delete-page.php?id=<?=$lost_id?>&type=img" class="btn btn-dark"> نعم </a>
            </div>
            </div>
        </div>

    </div>
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





</body>

</html>
