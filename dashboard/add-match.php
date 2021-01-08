<?php

$page_title = "أضافة مباراة";

if(isset($_GET['supervisor'])){
    $supervisor = 1;
    $labe = "مًدربة";
}else{
    $supervisor = 0;
    $labe = "بيانات";
}

?>
<?php include "includes/head.php";?>


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

                                <h5 class="m-0 font-weight-bold text-dark Font-tajawal text-center">  أضافة مباراة  </h5>
                            </div>
                            <div class="card-body">


                                <?php

                                date_default_timezone_set("Asia/Riyadh");
                                $time_now = time()+7800;
                                $time_stop = date('H:i A', $time_now);

                                ?>
                                <?php $team = new Equipe();
                                $row_team = $team->getAll();
                                ?>


                                <form onsubmit="return false" class="text-right">

                                    <label class="pull-right text-dark" for=""> الانديه </label>
                                    <div class="row">


                                        <div class="col-6">
                                            <div class="form-group">
<!--                                                <input type="text" name="name" id="team_host" class="form-control form-control-user"  placeholder="النادي الاول" >-->
                                                <select class="sl2 form-control form-control-user" id="team_host"   >

                                                    <?php foreach ($row_team as $val): ?>
                                                    <option value="<?=$val["id"]?>"><?=$val["fullTeamName"]?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
<!--                                                <input type="text" name="name" id="team_goust" class="form-control form-control-user" placeholder="النادي الثاني"  >-->
                                                <select class="sl2 form-control form-control-user" id="team_goust"   >

                                                    <?php foreach ($row_team as $val): ?>
                                                        <option value="<?=$val["id"]?>"><?=$val["fullTeamName"]?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="username" class="pull-right text-dark">رابط موقع البث من ستار</label>
                                    <div class="form-group">
                                        <input type="url" name="name" id="ks_link" class="form-control form-control-user"   >
                                    </div>

                                    <label for="username" class="pull-right text-dark">رابط السيرفر الاول</label>
                                    <div class="form-group">
                                        <input type="url" name="name" id="link1" class="form-control form-control-user"   >
                                        <label for="" class="pt-2"> للجوال فقط  	&nbsp;  <input type="checkbox" id="type1"> </label>
                                    </div

                                    <label for="username" class="pull-right text-dark">رابط السيرفر الثاني</label>
                                    <div class="form-group">
                                        <input type="url" name="name" id="link2" class="form-control form-control-user"   >
                                        <label for="" class="pt-2"> للجوال فقط  	&nbsp;  <input type="checkbox" id="type2"> </label>
                                    </div>

                                    <label for="username" class="pull-right text-dark">رابط السيرفر الثالث</label>
                                    <div class="form-group">
                                        <input type="url" name="name" id="link3" class="form-control form-control-user"   >
                                        <label for="" class="pt-2"> للجوال فقط  	&nbsp;  <input type="checkbox" id="type3"> </label>
                                    </div>

                                    <label for="pass" class="pull-right text-dark">اعلان منتصف البث</label>
                                    <div class="form-group">
                                        <select class="form-control form-control-user" id="center_ads">
                                            <option value="0">غير فعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                    </div>


                                    <label for="pass" class="pull-right text-dark">الوقت المتوقع ل انتهاء المبارة</label>
                                    <div class="form-group">
                                        <input type="time" name="depart" id="time" class="form-control form-control-user" placeholder="تحديد الوقت"   >
                                    </div>




                                    <input type="submit" onclick="addMatch()" name="add" value="أضافة" class="btn btn-dark btn-block">

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
<!--<script src="js/swal.js"></script>-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/ar.js"></script>

<script>

        $('.sl2').select2();

        $(" select option[value='282']").attr("selected","selected");

</script>

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
<script src="lib/flatpickr.js"></script>
<script src="lib/ar.js"></script>

<script>

    flatpickr.localize(flatpickr.l10ns.ar);
    $('#time').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        disableMobile: "true"
    })


</script>

<script>
    var start = new Date().getTime();

   function addMatch(){






        var ks_link=document.getElementById("ks_link").value;
        var link1=document.getElementById("link1").value;
        var link2=document.getElementById("link2").value;
        var link3=document.getElementById("link3").value;
        var type1=document.getElementById("type1").checked;
        var type2=document.getElementById("type2").checked;
        var type3=document.getElementById("type3").checked;
        var team_host=document.getElementById("team_host").value;
        var team_goust=document.getElementById("team_goust").value;
        var center_ads=document.getElementById("center_ads").value;
        var time=document.getElementById("time").value;
       const Url = "ajax/create_live.php";


        if (time == ""){

            Swal.fire({
                title: 'وقت نهاية المبارة',
                text: "لم يتم تحديد الوقت لذالك سوف يتم تحديد وقت الانتهاء في الساعه <?=$time_stop?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'موافق',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Todo send data to ajax with new time set

                    const data={
                        ks_link: ks_link,
                        link1: link1,
                        link2: link2,
                        link3: link3,

                        type1: type1,
                        type2: type2,
                        type3: type3,
                        team_host: team_host,
                        team_goust: team_goust,
                        time_type: "auto",
                        center_ads: center_ads,
                        time : "<?=$time_now?>"

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
                            setTimeout(function () { location.href = "./index.php";}, 3000);
                        }
                    })
                }
            })

        }else {

            const data={
                ks_link: ks_link,
                link1: link1,
                link2: link2,
                link3: link3,

                type1: type1,
                type2: type2,
                type3: type3,
                team_host: team_host,
                team_goust:team_goust,
                time_type: "manual",
                center_ads: center_ads,
                time : time

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
                    setTimeout(function () { location.href = "./index.php";}, 3000);
                }
            })

        }

    }
</script>

</body>

</html>
