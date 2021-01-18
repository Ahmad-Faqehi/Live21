<?php include "includes/head.php";
$msg_false = false;
$msg_true = false;
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
                <div class="row">

                    <div class="col-xl-12 col-lg-12">

                        <!-- Dropdown Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 ">
                                <h5 class="m-0 font-weight-bold text-dark text-center">بيانات التواصل</h5>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body"  >

                                <?php if($msg_true): ?>
                                    <div class="alert alert-success text-right">  تم الحذف بنجاح </div>
                                <?php endif; ?>
                                <?php if($msg_false): ?>
                                    <div class="alert alert-danger text-right">  حدث خطا أثناء الحذف </div>
                                <?php endif; ?>

                                <div class="text-center pb-4 ">
                                    <a href="#" data-toggle="modal" data-target="#add-team-form" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة نادي </span></a>
                                </div>

                                <div class="table-responsive" dir="ltr">

                                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                        <thead dir="">
                                        <tr>
                                            <th>No.</th>
                                            <th>أسم النادي</th>
                                            <th>تعديل</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $team = new Equipe();
                                      $rows = $team->getAll();
                                      $i=1;
                                        foreach ($rows as $row) :
                                            ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?php echo $row["fullTeamName"];?></td>
                                                <td><a href="edit-team.php?id=<?=$row['id']?>" class="btn btn-primary btn-circle"><i class="fas fa-edit"></i> </a> <a href="#dlete" onclick="myf(<?=$row["id"]?>)" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                        <?php
                                        $i++;
                                        endforeach;
                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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
                                هل متاكد من حذف البيانات؟
                            </p>
                            <a href="#" id="delete-link" class="btn btn-dark"> نعم </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="add-team-form" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-white"> أضافة نادي جديد </h4>
                    </div>
                    <div class="modal-body" style="font-size: 16px;">
                        <div class="text-center p-3">
                            <form onsubmit="return false">
                                <div class="form-group">
                                    <label class="text-dark">أسم النادي</label>
                                    <input type="text" class="form-control" id="team-name">
                                </div>
                                <input type="button" class="btn btn-secondary" onclick="addTeam()" value="أضافة">

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

    function  myf(id){

        $("#delete-link").attr("onclick", "deleteTeam("+id+")");
        $("#delete-lost").modal("show");
    }


    function deleteTeam(id) {

        var token = document.querySelector('meta[name="token"]').content;
        const Url = "ajax/delete-team.php";
        const data={
            token : token,
            id: id
        }
        $.post(Url,data ,function (response,status) {
            // console.log(response.m);
            swal.fire({
                title: response.t,
                text: response.m,
                icon: response.tp,
                showConfirmButton: response.b,
                confirmButtonText: 'موافق'
            });

            if(response.tp == "success"){
                setTimeout(function () { location.href = "./teams.php";}, 2000);
            }
        })

    }

    function addTeam() {

        var teamName=document.getElementById("team-name").value;
        var token = document.querySelector('meta[name="token"]').content;
        if (teamName == ""){

            swal.fire({
                title: "خطا",
                text: "يجب كتابة اسم النادي",
                icon: "error",
                showConfirmButton: true,
                confirmButtonText: 'موافق'
            });

        }else {
            const Url = "ajax/add-team.php";
            const data = {
                token : token,
                team_name: teamName
            }
            $.post(Url, data, function (response, status) {

                swal.fire({
                    title: response.t,
                    text: response.m,
                    icon: response.tp,
                    showConfirmButton: response.b,
                    confirmButtonText: 'موافق'
                });

                if (response.tp == "success") {
                    setTimeout(function () {
                        location.href = "./teams.php";
                    }, 2000);
                }
            })

        }
    }
</script>



</body>

</html>
