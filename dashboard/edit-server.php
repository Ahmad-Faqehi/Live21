
<?php
if(isset($_GET['id'])):
    $server_id = (int)$_GET['id'];
endif;
if(empty($server_id) OR !is_numeric($server_id))
    exit(header("Location: server.php"));
?>
<?php

include "includes/head.php";

$server = new ProLinks();
$row = $server->getById($server_id);
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
                                <h6 class="m-0 font-weight-bold text-dark Font-tajawal text-center">  تعديل سيرفر   </h6>
                            </div>
                            <div class="card-body">

                                <form onSubmit="return false" class="text-right">


                                    <label for="link_name" class="pull-right text-dark">اسم الاعلان </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="link_name"  value="<?=$row['channel'];?>" required>
                                    </div>

                                    <label for="link" class="pull-right text-dark">الرابط </label>
                                    <div class="form-group">
                                        <input type="url" class="form-control form-control-user" id="link"  value="<?=$row['url'];?>" required>
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


<!-- Page level custom scripts -->


<script>

    function update() {


        var link_name = document.getElementById("link_name").value;
        var link = document.getElementById("link").value;
        var token = document.querySelector('meta[name="token"]').content;
        const Url = "ajax/edit-server.php";

        const data={
            link_name: link_name,
            link_url: link,
            token : token,
            server_id: <?=$server_id?>
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
                setTimeout(function () { location.href = "./servers.php";}, 3000);
            }
        })

    }

</script>
</body>

</html>
