<?php
$page_title = "الصفحة الرئيسية";
include "includes/head.php";
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

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-futbol fa-2x text-gray-300"></i>

                                    </div>
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-dark text-uppercase mb-1 text-right Fonty">أجمالي المباريات</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800  pl-3"><?php echo  $conn->query("SELECT * FROM `matches`")->rowCount();  ?> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="far fa-eye fa-2x text-gray-300"></i>

                                    </div>
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-dark text-uppercase mb-1 text-right Fonty">أجمالي عدد الزيارات</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800  pl-3">  <?php //echo  $conn->query("SELECT * FROM `matches`")->rowCount();  ?> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
                $matches = new Live();
                $teams = new Equipe();
                $rows = $matches->getMatchesOn();
                if(!empty($rows)):
                ?>

                <div class="row">

                    <div class="col-xl-12 col-lg-12">

                        <!-- Dropdown Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 ">
                                <h5 class="m-0 font-weight-bold text-dark text-center fonty">المبارايات التي تلعب حالياً</h5>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body"  >
                                     <div class="table-responsive" dir="ltr">

                                    <table class="table   text-dark   text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                        <thead dir="">
                                        <tr>

                                            <th>عنوان المباراة</th>
                                            <th>حالة البث</th>
                                            <th>خيارات</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        foreach ($rows as $row) :
                                            ?>
                                            <tr>

                                                <td><?php echo getTeamsNames($row["Team_Gust"],$row["Team_Host"])?></td>
                                                <td> <label class="switch">
                                                        <input type="checkbox" id="state_match_<?=$row['id']?>" onclick="stopLive(<?=$row['id']?>)" <?php if($row["State_Match"]): ?> checked <?php endif; ?> >
                                                        <span class="slider round"></span>
                                                    </label> </td>
                                                <td>
                                                    <a href="edit-match.php?id=<?=$row['id']?>" class="btn btn-primary btn-circle"><i class="fas fa-edit"></i> </a>
                                                    <a href="../match/<?=$row['id']?>" target="_blank" class="btn btn-info btn-circle"><i class="fas fa-eye"></i></a>
                                                </td>
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
                <?php
                endif;
                ?>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <?php include "includes/footer.php";?>

<script>

    function stopLive(id) {
        var token = document.querySelector('meta[name="token"]').content;
        const Url = "ajax/stop-live.php";
        const data={
            matchid : id,
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
                $( "#state_match_"+id ).attr("onclick","runLive("+id+")");

            }
        })

    }

    function runLive(id) {
        var token = document.querySelector('meta[name="token"]').content;
        const Url = "ajax/run-live.php";
        const data={
            matchid : id ,
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
                $( "#state_match_"+id ).attr("onclick","stopLive("+id+")");

            }
        })

    }
</script>

</body>

</html>
