<?php


$page_title = "الاعلانات";

?>
<?php include "includes/head.php";?>
<?php  if($_SESSION['dashRank:TVTC'] != "admin"){exit(header("Location: index.php"));} ?>

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
                        $users = new User();
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
                                            <th>#.</th>
                                            <th>أسم المستخدم</th>
                                            <th>تعديل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        foreach ($users->getAll() as $user) : ?>

                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?=$user['Username']?></td>
                                                <td><a href="edit-user.php?id=<?=$user['id']?>" class="btn btn-primary">تعديل</a></td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#add-user-form" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة مستخدم</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div id="add-user-form" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-white"> أضافة مستخدم جديد </h4>
                    </div>
                    <div class="modal-body" style="font-size: 16px;">
                        <div class=" text-right p-3"  >
                            <form onsubmit="return false">
                                <div class="form-group">
                                    <label class="text-dark">أسم المستخدم</label>
                                    <input type="text" class="form-control" id="username">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">الائميل</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">كلمة السر</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">اعادة كلمة السر</label>
                                    <input type="password" class="form-control" id="repassword">
                                </div>
                                <input type="button" class="btn btn-secondary" onclick="addUser()" value="أضافة">

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
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }




    function addUser() {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var repassword = document.getElementById("repassword").value;
        var token = document.querySelector('meta[name="token"]').content;

        if(password !== repassword){

            swal.fire({
                title: "خطاء",
                text: "كلمة السر غير متطابقتين",
                icon: "warning",
                showConfirmButton: true,
                confirmButtonText: 'موافق'
            });

        }else if(!validateEmail(email)){

            swal.fire({
                title: "خطاء",
                text: "يجب ان يكتب الائميل بشكل صحيح",
                icon: "warning",
                showConfirmButton: true,
                confirmButtonText: 'موافق'
            });

        }else if (username == "" || password == "" || repassword == "" || email == "") {
            swal.fire({
                title: "خطاء",
                text: "جميع الحقول مطلوبة",
                icon: "error",
                showConfirmButton: true,
                confirmButtonText: 'موافق'
            });
        }else {
            const Url = "ajax/add-user.php";
            const data = {
                username: username,
                email: email,
                token : token,
                password: password
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
                        location.href = "./users.php";
                    }, 3000);
                }
            })
        }

    }
</script>


</body>

</html>
