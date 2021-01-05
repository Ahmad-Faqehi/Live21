<?php

//if(!isset($_GET['do'])): header("Location: home.html"); die(); endif;
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

$msg_false = false;
$msg_true = false;

?>
<?php include "includes/head.php";?>

<?php
if(isset($_SESSION['alert:true'])){
    $msg_true = true;
    unset($_SESSION['alert:true']);
}

if (isset($_SESSION['alert:false'])){
    $msg_false = true;
    unset($_SESSION['alert:false']);
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

    .blog-sidebar .blog-widgets {
        padding: 30px;
        border-radius: 5px;
        margin-bottom: 30px;
        -webkit-transition: all 0.25s ease;
        transition: all 0.25s ease;
        /*-webkit-box-shadow: 0 20px 60px 0 rgba(40, 93, 251, 0.16);*/
        /*        box-shadow: 0 20px 60px 0 rgba(40, 93, 251, 0.16);*/
        border: 1px solid #ccc!important;
    }

    .blog-sidebar .blog-widgets .blog-search-btn {
        top: 0;
        right: 0;
        border: none;
        width: 60px;
        outline: none;
        height: 100%;
        position: absolute;
        background: #6c63ff;
        color: #fff;
        border-radius: 0 5px 5px 0;
    }

    .blog-sidebar .blog-widgets .blog-search-bar {
        width: 100%;
    }

    .blog-sidebar .blog-widgets .blog-search-bar .search-form-control {
        width: 100%;
        display: block;
        border-radius: 5px;
        padding: 18px 20px;
        border: none;
        -webkit-transition: all 0.25s ease;
        transition: all 0.25s ease;
        -webkit-box-shadow: 0 13px 30px 0 rgba(40, 93, 251, 0.16);
        box-shadow: 0 13px 30px 0 rgba(40, 93, 251, 0.16);
    }

    .blog-sidebar .recent-post-item {
        margin-bottom: 20px;
    }

    .blog-sidebar .recent-post-item:last-child {
        margin-bottom: 0;
    }

    .blog-sidebar .recent-post-item .recent-post-img {
        float: left;
    }

    .blog-sidebar .recent-post-item .recent-post-img img {
        border-radius: 5px;
    }

    .blog-sidebar .recent-post-item .recent-post-body .recent-post-title {
        margin-bottom: 14px;
        line-height: 1.5;
    }

    .blog-sidebar .recent-post-item .recent-post-body .recent-post-title:hover {
        color: #6c63ff;
    }

    .blog-sidebar .recent-post-item .recent-post-body .recent-post-date i {
        margin-right: 8px;
        color: #6c63ff;
    }

    .blog-sidebar .blog-category-list li {
        margin-bottom: 15px;
    }

    .blog-sidebar .blog-category-list li:last-child {
        margin-bottom: 0;
    }

    .blog-sidebar .blog-category-list li:before {
        content: "\f101";
        display: inline-block;
        margin-right: 10px;
        vertical-align: middle;
        color: #6c63ff;
        font-family: "Font Awesome 5 Free";
        font-weight: 700;
    }

    .blog-sidebar .blog-category-list li a {
        color: #17203a;
        font-weight: 500;
    }

    .blog-sidebar .blog-category-list li a:hover, .blog-sidebar .blog-category-list li a.active {
        color: #6c63ff;
    }

    .blog-sidebar .blog-category-list li a .category-count {
        float: right;
    }

    .blog-sidebar .blog-tags li {
        float: left;
    }

    .blog-sidebar .blog-tags li a {
        margin: 5px;
        font-size: 14px;
        display: inline-block;
        color: #000;
        padding: 10px 15px;
        border-radius: 5px;
        -webkit-transition: all 0.25s linear;
        transition: all 0.25s linear;
        -webkit-box-shadow: 0 10px 20px 0 rgba(61, 82, 96, 0.15);
        box-shadow: 0 10px 20px 0 rgba(61, 82, 96, 0.15);
    }

    .blog-sidebar .blog-tags li a:hover, .blog-sidebar .blog-tags li a.active {
        background: #6c63ff;
        color: #fff;
    }

    .blog-sidebar .tag-widgets {
        padding: 30px 25px 25px 25px;
        margin-bottom: 0;
    }

    .blog-sidebar .tag-widgets .inner-header-title {
        margin-left: 5px;
    }

    @media (min-width: 992px){
        .des-m-25 {
            margin-right: 25% !important;
        }
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

                <!-- Topbar Search -->
                <!--          <form class="d-none d-sm-inline-block form-inline mr-auto mr-md-3 my-2 my-md-0 mw-100 navbar-search">-->
                <!--            <div class="input-group">-->
                <!--              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">-->
                <!--              <div class="input-group-append">-->
                <!--                <button class="btn btn-dark" type="button">-->
                <!--                  <i class="fas fa-search fa-sm"></i>-->
                <!--                </button>-->
                <!--              </div>-->
                <!--            </div>-->
                <!--          </form>-->

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


                    <div class="col-md-6 text-center pt-1 mb-4 des-m-25 " dir="rtl">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-dark Fonty text-center">قائمة المفقودات</h5>
                            </div>
                            <div class="card-body">

                                <div class="row justify-content-center">
                                    <div class="pb-3">
                                        <a href="add-lose.php" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة مفقود جديد</span></a>
                                    </div>
                                    <div class="blog-sidebar" style="width: 85%;">

                                        <?php if($msg_true): ?>
                                            <div class="alert alert-success">  تم الحذف بنجاح </div>
                                        <?php endif; ?>
                                        <?php if($msg_false): ?>
                                            <div class="alert alert-danger">  حدث خطا أثناء الحذف </div>
                                        <?php endif; ?>
                                        <div class="blog-widgets text-right " >


                                            <?php

                                            $stmt=$conn->prepare("SELECT * FROM `lost` ORDER BY `lost`.`date` DESC ");
                                            $stmt->execute();
                                            $count = 0;
                                            if($stmt->rowCount() > 0) :
                                            $rows = $stmt->fetchAll();
                                            foreach ($rows as $row) :
                                            $title = $row['title'];
                                            $id_lost = $row['id'];
                                            $image = $row['image'];
                                            $date = $row['date'];
                                            $state = $row['state'];
                                            ?>

                                                <div class="recent-post-item clearfix">
                                                    <div class="  mr-3">
                                                        <a href="#" data-toggle="modal" data-target="#show_m<?=$id_lost?>">
                                                            <img class="img-fluid w-50" src="../img/lost/<?php if(!empty($image)): echo $image; else: echo "placeholder.png"; endif; ?>" alt="صورة المفقودات" style="float: left;">
                                                        </a>
                                                    </div>
                                                    <div class="recent-post-body">
                                                        <a href="#" data-toggle="modal" data-target="#show_m<?=$id_lost?>">
                                                            <h6 class="recent-post-title fo "><?=$title?></h6>
                                                        </a>
                                                        <p class="recent-post-date" dir="ltr"><?php echo  date('d M, Y', $date)?></p>
                                                        <p class="recent-post-date" dir=""><a dir="ltr" href="edit-lost.php?id=<?=$row['id']?>" class="btn btn-primary btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-edit " style="color: rgba(255,255,255,.5)!important; margin-right: 0px;"></i></span><span class="text">تعديل</span></a>&nbsp; <a href="#dlete" onclick="myf(<?=$row['id']?>)" class="btn btn-danger btn-circle  btn-sm"><i class="fas fa-trash text-white" style="margin-right: 0px;"></i></a>  </p>
                                                        <?php if($state): ?>
                                                            <div > <a href="#"  class="btn btn-success text-white btn-circle btn-sm"><i class="fas fa-check text-white" style="margin-right: 0px;"></i></a>   </div>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                                <hr>

                                           <?php endforeach; ?>
                                            <?php else: ?>

                                            <div class="p-5">
                                                <h6 class="text-center"> لايوجد مفقودات </h6>
                                            </div>
                                            <?php endif; ?>


                                        </div>


                                    </div>
                                </div>

                    </div>

                </div>

            </div>

        </div>


                <!-- Todo Show models for every lost -->
                <?php
                foreach ($rows as $row) :
                    $id_lost = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];

                    if($description):
                        ?>
                        <div id="show_m<?=$id_lost?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <div class="modal-header bg-dark" style="direction: rtl;">
                                        <h5 class="modal-title text-white"> <?=$title?> </h5>
                                    </div>
                                    <div class="modal-body" style="font-size: 16px;">
                                        <div class="text-right">
                                            <p class="text-justify text-dark  p-2" dir="rtl">
                                                <?=$description?>
                                            </p>

                                        </div>

                                        <div class="text-center pt-2">
                                            <hr>
                                            <button type="button" class=" btn btn-secondary text-center" data-dismiss="modal"> اغلاق </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php
                    endif;
                endforeach;
                ?>

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

<div id="delete-lost" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-white"> </h4>
            </div>
            <div class="modal-body" style="font-size: 16px;">
                <div class="text-center">
                    <p class="text-justify text-dark text-center">
                        هل متاكد من حذف هذا المفقود؟
                    </p>
                    <a href="#" id="delete-link" class="btn btn-dark"> نعم </a>
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

<script>

    function  myf(id){

        $("#delete-link").attr("href", "delete-page.php?type=lost&id="+id);
        $("#delete-lost").modal("show");
    }
</script>
<!-- Page level custom scripts -->


</body>

</html>
