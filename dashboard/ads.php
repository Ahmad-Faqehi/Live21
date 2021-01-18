<?php


$page_title = "الاعلانات";

?>
<?php include "includes/head.php";?>
<?php if($_SESSION['dashRank:TVTC'] != "admin"){exit(header("Location: index.php"));} ?>
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
    <?php include "includes/menu.php";?>
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
                <div class="row">

                    <div class="col-xl-12 col-lg-12">

                        <?php
                        $ad = new Ads();
                        ?>
                        <!-- Dropdown Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 ">
                                <h5 class="m-0 font-weight-bold text-dark text-center">الاعلانات</h5>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body" style="direction: ltr;">

                                <div class="table-responsive">
                                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                        <thead dir="">
                                        <tr>
                                            <th>أسم</th>
                                            <th>الحالة</th>
                                            <th>تعديل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            foreach ($ad->getAll() as $the_Ad) : ?>

                                                <tr>
                                                    <td><?=$the_Ad['Ads_Name']?></td>
                                                    <td><?php echo  getState($the_Ad['Ads_Work'])?></td>
                                                    <td><a href="edit-ads.php?id=<?=$the_Ad['id']?>" class="btn btn-primary">تعديل</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
<!--                                <div class="text-center">-->
<!---->
<!--                                    <a href="add-user.php" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة مسؤال</span></a>-->
<!---->
<!--                                </div>-->
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




</body>

</html>
