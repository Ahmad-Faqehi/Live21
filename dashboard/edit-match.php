<?php

$page_title = "تعديل مباراة";


if (isset($_GET['id'])):
    $match_id = (int)$_GET['id'];
endif;
if (empty($match_id) OR !is_numeric($match_id))
    exit(header("Location: index.php"));


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

    #only-date::placeholder{
        text-align: right;
    }

    #only-time::placeholder{
        text-align: right;
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

                                <h5 class="m-0 font-weight-bold text-dark Font-tajawal text-center">  تعديل مباراة  </h5>
                            </div>
                            <div class="card-body">


                                <?php

                                date_default_timezone_set("Asia/Riyadh");
                                $time_now = time()+7800;
                                $time_stop = date('h:i A', $time_now);

                                $dayNow = date('l', time());
                                $dateNow = date('Y-m-d', time());
                                $dayTommoro = date('l', strtotime( $dateNow . " +1 days"));

                                ?>
                                <?php $team = new Equipe();
                                $row_team = $team->getAll();
                                $match = new Live();
                                $row_match = $match->getById($match_id);
                                if(!$row_match){

                                    exit("<script>location.href = \"./matches.php\";</script>");
                                }

                                $proLink = new ProLinks();
                                $links = new Links();
                                $row_link = $links->getById($row_match['Custom_Link']);

                                ?>


                                <form onsubmit="return false" class="text-right">

                                    <label class="pull-right text-dark" for=""> الانديه </label>
                                    <div class="row">


                                        <div class="col-6">
                                            <div class="form-group">
                                                <select class="sl2 form-control form-control-user" id="team_host"   >

                                                    <?php foreach ($row_team as $val): ?>
                                                        <option value="<?=$val["id"]?>" <?php if ($val["id"] == $row_match['Team_Host']){echo "selected";} ?> ><?=$val["fullTeamName"]?></option>
                                                    <?php endforeach; ?>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select class="sl2 form-control form-control-user" id="team_goust"   >

                                                    <?php foreach ($row_team as $val): ?>
                                                        <option value="<?=$val["id"]?>" <?php if ($val["id"] == $row_match['Team_Gust']){echo "selected";} ?>   ><?=$val["fullTeamName"]?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="username" class="pull-right text-dark"> رابط موقع البث من ستار <span class="text-dark" id="what"> <i class="far fa-question-circle text-primary"></i></span></label>
                                    <div class="form-group">
                                        <input type="url" name="name" id="ks_link" class="form-control form-control-user" value="<?=$row_match['KS_URL']?>"   >
                                    </div>

                                    <label for="username" class="pull-right text-dark">رابط السيرفر الاول</label> <span id="show-servers1" class="btn-link"> عرض السيرفرات  </span>
                                    <div class="form-group">
                                        <input type="url" name="name" id="link1" class="form-control form-control-user" value="<?=$row_link['Link1']?>"   >
                                        <label for="type1" class="pt-2"> للجوال فقط  	&nbsp;  <input type="checkbox" id="type1"> </label>
                                    </div

                                    <label for="username" class="pull-right text-dark">رابط السيرفر الثاني</label> <span id="show-servers2" class="btn-link"> عرض السيرفرات  </span>
                                    <div class="form-group">
                                        <input type="url" name="name" id="link2" class="form-control form-control-user"  value="<?=$row_link['Link2']?>" >
                                        <label for="type2" class="pt-2"> للجوال فقط  	&nbsp;  <input type="checkbox" id="type2"> </label>
                                    </div>

                                    <label for="username" class="pull-right text-dark">رابط السيرفر الثالث</label> <span id="show-servers3" class="btn-link"> عرض السيرفرات  </span>
                                    <div class="form-group">
                                        <input type="url" name="name" id="link3" class="form-control form-control-user " value="<?=$row_link['Link3']?>"  >
                                        <label for="type3" class="pt-2"> للجوال فقط  	&nbsp;  <input type="checkbox" id="type3"> </label>
                                    </div>

                                    <label for="pass" class="pull-right text-dark">اعلان منتصف البث</label>
                                    <div class="form-group">
                                        <select class="form-control form-control-user" id="center_ads">
                                            <option value="0">غير فعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                    </div>


                                        <label for="pass" class="pull-right text-dark">وقت نهاية المبارة</label>
                                        <div class="form-group"  >

                                            <input type="hidden" id="hiden-time" value="<?=$row_match['Time_OFF']?>">
                                            <input type="text" id="show-time" readonly="" class="form-control form-control-user border-dark" placeholder="تحديد الوقت"  value="<?php if($row_match["Time_OFF"]) echo date('h:i A', $row_match["Time_OFF"])   ?>"  >
                                        </div>



                                    <div class="text-center p-3">
                                    <div class="">


                                        <span  class="text-dark">حالة البث</span> &nbsp;
                                        <label class="switch">
                                            <input type="checkbox" id="state_match">
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                    </div>

                                    <input type="button" onclick="addMatch()"  name="add" value="تعديل" class="btn btn-dark btn-block">

                                </form>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="what-ks" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> أضافة نادي جديد </h4>
                </div>
                <div class="modal-body" style="font-size: 16px;">
                    <div class="text-center p-3">

                        <p class="text-dark">
                            قم بلصق رابط المبارة من موقع <a href="http://table.super-kora.tv/" target="_blank" class="btn-link">كورة ستار</a>   بعد ذالك سوف يتم استخراج البثوث المستخدمة لديهم و يتم تحديثها تلقائي
                        </p>

                        <span class="text-dark">مثال على رابط مبارة من كورة ستار:</span>
                        <br>
                        <span class="text-primary">https://b.kora-star.tv/2020/12/Juventus-vs-Milan.html</span>


                    </div>
                </div>
            </div>

        </div>
    </div>


    <div id="set-time" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> تحديد وقت أنتهاء المباراة </h4>
                </div>
                <div class="modal-body" style="font-size: 16px;">
                    <div class="text-center p-3">
                        <form onsubmit="return false">
                            <div class="form-group" dir="ltr">
                                <label class="text-dark">الوقت المتوقع لنهاية</label>
<!--                                <input type="text" name="depart"  id="time1" class="form-control form-control-user border-dark" placeholder="تحديد الوقت"  value="--><?php //if($row_match["Time_OFF"]) echo date('Y-m-d H:i', $row_match["Time_OFF"])   ?><!--"  >-->
                                <input type="text" class="form-control form-control-user  "  id="only-time" data-field="time" placeholder="تحديد الوقت"  readonly>
                                <br>
                                <input type="text" class="form-control form-control-user  " id="only-date" data-field="date"  data-min="<?=date('Y-m-d', time())?>" data-max="<?=date('Y-m-d', strtotime( date('Y-m-d', time()) . " +2 days"))?>" placeholder="تحديد التاريخ"  readonly>
                                <div id="dtBox"></div>

                            </div>
                            <input type="button" class="btn btn-secondary" onclick="editTime()" value="تعديل">

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="proLinks" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> سيرفرات قنوات </h4>
                </div>
                <div class="modal-body" style="font-size: 16px;">
                    <div class="text-center p-3">

                        <div class="text-dark pb-2">
                            ملاحظة: هذي السيرفرات تم أضافتها عشوائياً الرجاء التاكد منها من خلال صفحة <a href="servers.php" class="btn-link"> روابط السيرفرات </a>
                        </div>

                        <form onsubmit="return false">
                            <input type="hidden" id="forWho">
                            <div class="form-group">
                                <select class=" form-control" id="server">
                                    <?php foreach ($proLink->getAllChannel() as $val): ?>
                                        <option value="<?=$val["url"]?>"><?=$val["channel"]?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="submit" onclick="setServer()" class="btn btn-dark" value="تحديد">
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

<!-- Page level custom scripts -->
<script type="text/javascript" src="js/DateTimePicker.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/ar.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script src="lib/ar.js"></script>
<script>
    $("#hid-time").hide()

    $( "#what" ).click(function() {
        $('#what-ks').modal('show');
    });

    $( "#show-servers1" ).click(function() {
        $('#forWho').val("1");
        $('#proLinks').modal('show');
    });

    $( "#show-servers2" ).click(function() {
        $('#forWho').val("2");
        $('#proLinks').modal('show');
    });

    $( "#show-servers3" ).click(function() {
        $('#forWho').val("3");
        $('#proLinks').modal('show');
    });

    $( "#show-time" ).click(function() {
        $('#set-time').modal('show');
    });

    $('.sl2').select2();


    function setServer() {
        var forWho=document.getElementById("forWho").value;
        var server=document.getElementById("server").value;

        $("#link"+forWho).val(server);
        $('#proLinks').modal('hide');


    }

</script>
<script>
    $(document).ready(function()
    {
        $("#dtBox").DateTimePicker({
            dateFormat: "yyyy-MM-dd",
            timeFormat: "hh:mm AA",

        });

    });
    function validURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
            '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        return !!pattern.test(str);
    }

   function editTime(){
       $("input").removeClass("border border-danger");

       var time_now = Math.floor(Date.now() / 1000);
       var time=document.getElementById("only-time").value;
       var date=document.getElementById("only-date").value;
       var selectedTime = Date.parse(date + " " + time)/1000;
       var token = document.querySelector('meta[name="token"]').content;
       const Url = "ajax/edit-time.php";

       if(time == ""){
           Swal.fire({
               title: 'حقل مطلوب',
               text: 'الرجاء تحديد وقت أنتهاء المبارة',
               icon: 'warning',
               confirmButtonColor: '#3085d6',
               confirmButtonText: 'موافق'
           })
           $("#only-time").addClass("border border-danger");
           return
       }

       if(date == ""){
           Swal.fire({
               title: 'حقل مطلوب',
               text: 'الرجاء تحديد تاريخ أنتها المبارة',
               icon: 'warning',
               confirmButtonColor: '#3085d6',
               confirmButtonText: 'موافق'
           })
           $("#only-date").addClass("border border-danger");
           return
       }

       if(time_now >= selectedTime){

           Swal.fire({
               title: 'الوقت غير صالح',
               text: 'لقد أدخلت وقت و تاريخ منتهي الرجاء اختيار تاريخ صحيح ',
               icon: 'warning',
               confirmButtonColor: '#3085d6',
               confirmButtonText: 'موافق'
           })

           return
       }

       const data = {
           token : token,
           match_id : <?=$row_match['id']?>,
           time: selectedTime
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
               // setTimeout(function () {
               //     location.href = "./teams.php";
               // }, 2000);
               $("#show-time").val(time);
               $("#hiden-time").val(selectedTime);
               $('#set-time').modal('hide');
           }
       })


       //console.log(time + "  " + date)

   }

    // for ad center
    $("#center_ads option[value=<?=$row_match['Center_Ad']?>]").attr("selected","selected");

    // for link type 1
    <?php if ($row_link["Type_Link1"] == 0):?>
    $("#type1").attr('checked','checked');
    <?php endif; ?>

    // for link type 2
    <?php if ($row_link["Type_Link2"] == 0):?>
    $("#type2").attr('checked','checked');
    <?php endif; ?>


    // for link type 3
    <?php if ($row_link["Type_Link3"] == 0):?>
    $("#type3").attr('checked','checked');
    <?php endif; ?>

    // for state of match
    <?php if ($row_match["State_Match"] == 1):?>
    $("#state_match").attr('checked','checked');
    <?php endif; ?>


</script>

<script>

    function addMatch(){
        $("input").removeClass("border border-danger");





        var time_now = Math.floor(Date.now() / 1000);
        var ks_link=document.getElementById("ks_link").value;
        var link1=document.getElementById("link1").value;
        var link2=document.getElementById("link2").value;
        var link3=document.getElementById("link3").value;
        var type1=document.getElementById("type1").checked;
        var type2=document.getElementById("type2").checked;
        var type3=document.getElementById("type3").checked;
        var state_match=document.getElementById("state_match").checked;
        var team_host=document.getElementById("team_host").value;
        var team_goust=document.getElementById("team_goust").value;
        var center_ads=document.getElementById("center_ads").value;
        var time=document.getElementById("hiden-time").value;
        var token = document.querySelector('meta[name="token"]').content;
        const Url = "ajax/edit-live.php";



        // TOdo: Valtded the Links if not empty

        if(link1 == "" && link2 == "" && link3 == "" && ks_link == ""){
            Swal.fire({
                title: 'لا يوجد رابط',
                text: 'يجب ان يكون هناك رابط سيرفر واحد على الاقل',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'موافق'
            })
            return
        }

        if (ks_link != "" && !validURL(ks_link)){
            Swal.fire({
                title: 'تحقق من الرابط',
                text: 'رابط كوره ستار مدخل بشكل غير صحيح',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'موافق'
            })
            $("#ks_link").addClass("border border-danger");
            return
        }

        if (link1 != "" && !validURL(link1)){
            Swal.fire({
                title: 'تحقق من الرابط',
                text: 'رابط سيرفر1 مدخل بشكل غير صحيح',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'موافق'
            })
            $("#link1").addClass("border border-danger");
            return
        }

        if (link2 != "" && !validURL(link2)){
            Swal.fire({
                title: 'تحقق من الرابط',
                text: 'رابط سيرفر2 مدخل بشكل غير صحيح',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'موافق'
            })
            $("#link2").addClass("border border-danger");
            return
        }

        if (link3 != "" && !validURL(link3)){
            Swal.fire({
                title: 'تحقق من الرابط',
                text: 'رابط سيرفر3 مدخل بشكل غير صحيح',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'موافق'
            })
            $("#link3").addClass("border border-danger");
            return
        }

        if ( time <= time_now && state_match){

            Swal.fire({
                title: 'وقت نهاية المبارة',
                text: 'الوقت المحدد منتهي,  سوف يتم تحديد وقت نهاية المبارة تلقائياً في  <?=$time_stop?>',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'موافق',
                cancelButtonText: 'تعديل'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Todo send data to ajax with new time set

                    const data={
                        links_id : <?php if(!empty($row_match['Custom_Link'])){ echo $row_match['Custom_Link']; }else{ echo "null"; }?>,
                        match_id : <?=$row_match['id']?>,
                        ks_link: ks_link,
                        link1: link1,
                        link2: link2,
                        link3: link3,
                        token : token,

                        type1: type1,
                        type2: type2,
                        type3: type3,
                        state_match: state_match,
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
                            setTimeout(function () { location.href = "./matches.php";}, 3000);
                        }
                    })
                }else if(result.dismiss) {
                    $('#set-time').modal('show');
                }
            })

            }else {

                var theTime = document.getElementById("show-time").value;
                    const data = {
                        links_id: <?php if (!empty($row_match['Custom_Link'])) {
                            echo $row_match['Custom_Link'];
                        } else {
                            echo "null";
                        }?>,
                        match_id: <?=$row_match['id']?>,
                        ks_link: ks_link,
                        link1: link1,
                        link2: link2,
                        link3: link3,
                        token: token,

                        type1: type1,
                        type2: type2,
                        type3: type3,
                        state_match: state_match,
                        team_host: team_host,
                        team_goust: team_goust,
                        time_type: "manual",
                        center_ads: center_ads,
                        time: theTime

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
                                location.href = "./matches.php";
                            }, 3000);
                        }
                    })

            }

        }


</script>

</body>

</html>
