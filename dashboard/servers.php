<?php


$page_title = "روابط السيرفرات";

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
                        $links = new ProLinks();
                        ?>
                        <!-- Dropdown Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 ">
                                <h5 class="m-0 font-weight-bold text-dark text-center">السيرفرات</h5>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body" style="direction: ltr;">

                                <div class="table-responsive">
                                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                        <thead dir="">
                                        <tr>
                                            <th>القناة</th>
                                            <th>تعديل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        foreach ($links->getAll() as $the_Link) : ?>

                                            <tr>
                                                <td><?=$the_Link['channel']?></td>
                                                <td>
                                                    <a href="<?=$the_Link['url']?>" target="_blank" class="btn btn-info">عرض</a>

                                                    <a href="edit-server.php?id=<?=$the_Link['id']?>"  class="btn btn-primary">تعديل</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#add-server" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة قناة</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div id="add-server" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-white"> أضافة سيرفر جديد </h4>
                    </div>
                    <div class="modal-body" style="font-size: 16px;">
                        <div class="text-center p-3">
                            <form onSubmit="return false">
                                <div class="form-group">
                                    <label class="text-dark">أسم السيرفر</label>
                                    <input type="text" class="form-control" id="server-name">
                                </div>

                                <div class="form-group">
                                    <label class="text-dark">الرابط</label>
                                    <input type="url" class="form-control" id="server-url">
                                </div>
                                <input type="button" class="btn btn-secondary" onclick="addServer()" value="أضافة">

                            </form>
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
    function addServer() {

        var server_name =  document.getElementById("server-name").value;
        var server_url  =  document.getElementById("server-url").value;
        var token = document.querySelector('meta[name="token"]').content;
        const Url = "ajax/add-server.php";

        const data={
            link_name: server_name,
            link_url: server_url,
            token : token
        }

        if(server_url == "" || server_name == ""){
            swal.fire({
                title: "خطاء",
                text: "جميع الحقول مطلوبة",
                icon: "error",
                showConfirmButton: true,
                confirmButtonText: 'موافق'
            });
            return
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
                setTimeout(function () { location.href = "./servers.php";}, 2000);
            }
        })
    }
</script>

</body>

</html>
