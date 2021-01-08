
<?php
if(isset($_GET['id'])):
    $ad_id = (int)$_GET['id'];
endif;
if(empty($ad_id) OR !is_numeric($ad_id))
    exit(header("Location: ads.php"));
?>
<?php

include "includes/head.php";
$ad = new Ads();
$row = $ad->getById($ad_id);
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
                                <h6 class="m-0 font-weight-bold text-dark Font-tajawal text-center">  تعديل الاعلان   </h6>
                            </div>
                            <div class="card-body">

                                <form onsubmit="return false" class="text-right">


                                    <label for="username" class="pull-right text-dark">اسم الاعلان </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="ad_name"  value="<?=$row['Ads_Name'];?>" required>
                                    </div>

                                    <label for="username" class="pull-right text-dark">شفرة الاعلان</label>
                                    <div class="form-group" dir="ltr">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" id="ad_code" rows="7"><?=$row['Ads_Code']?></textarea>

                                    </div>

                                    <?php

                                        ?>
                                        <label for="username" class="pull-right text-dark">حالة الاعلان</label>
                                        <div class="form-group">
                                            <select class="form-control" name="dep" id="select">
                                                <option value="0" id="not_work">غير فعال</option>
                                                <option value="1" id="work">فعال</option>

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
<?php if($row['Ads_Work'] == 0): ?>  $("#not_work").attr("selected","selected");  <?php endif; ?>
<?php if($row['Ads_Work'] == 1): ?>  $("#work").attr("selected","selected");  <?php endif; ?>


</script>

<script>
    function update() {

        var ad_code = $("textarea").val();
        var ad_name = document.getElementById("ad_name").value;
        var ad_type = document.getElementById("select").value;
        const Url = "ajax/edit-ads.php";
        const data={
            ad_code: ad_code,
            ad_name: ad_name,
            ad_type: ad_type,
            ad_id: <?=$ad_id?>
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
                setTimeout(function () { location.href = "./ads.php";}, 3000);
            }
        })

    }

</script>
</body>

</html>
