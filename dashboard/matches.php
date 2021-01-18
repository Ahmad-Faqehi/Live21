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

                                <?php


                                ?>
                                <div class="table-responsive" dir="ltr">

                                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl" >
                                        <thead >
                                        <tr>
                                            <th>NO.</th>
                                            <th>مباراة</th>
                                            <th id="spare" style="display: none">شغال</th>
<!--                                            <th>عرض المشغلات</th>-->
<!--                                            <th>صفحة البث</th>-->
                                            <th>خيارات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $matches = new Live();
                                        $teams = new Equipe();
                                        $rows = $matches->getAll();
                                            foreach ($rows as $row) :
                                                // get the true mark from getState function and remove the text only i need the mark
                                                $sta = getState($row["State_Match"]);
                                                $markOnly = str_replace(array("فعال", "غير"),"", getState($row["State_Match"]));
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id']?></td>
                                                    <td><?=getTeamsNames($row["Team_Gust"],$row["Team_Host"])?> <?=$markOnly?> </td>
                                                    <td style="display: none" id="spare"> <?php if($row["State_Match"] == 1): echo 1; else: echo 0; endif;?> </td>
                                                    <td>
                                                        <a href="edit-match.php?id=<?=$row['id']?>" class="btn btn-primary btn-circle"><i class="fas fa-edit"></i> </a>
                                                        <a href="../match/<?=$row['id']?>" target="_blank" class="btn btn-info btn-circle"><i class="fas fa-eye"></i></a>
                                                        <a href="#" onclick="deletMatch(<?=$row['id']?>)" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
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



        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include "includes/footer.php";?>

<script>

    $("#spare").hide();

    var table = $('#dataTable').DataTable();

    // Sort by column 1 and then re-draw
    table
        .order( [ 2, 'desc' ] )
        .draw();

    function  myf(id){

        $("#delete-link").attr("href", "delete-page.php?type=list&id="+id);
        $("#delete-lost").modal("show");
    }

    function deletMatch(id) {


        const Url = "ajax/delete_live.php";
        var token = document.querySelector('meta[name="token"]').content;


        Swal.fire({
            title: 'حذف المبارة',
            text: "هل متاكد من حذف المباراة نهائياً؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم',
            cancelButtonText: 'الغاء'
        })
            .then((result) => {
                if (result.isConfirmed) {
                    // Todo send data to ajax with new time set

                    const data={
                        match_id: id,
                        token : token
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
                            setTimeout(function () { location.href = "./matches.php";}, 1000);
                        }
                    })
                }
            })
    }
</script>



</body>

</html>
