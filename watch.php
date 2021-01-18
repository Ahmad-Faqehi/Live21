<?php

if(isset($_GET['match_id']) && is_numeric($_GET['match_id'])) {


    include "dashboard/includes/require.php";
    include "dashboard/includes/functions.php";

    $match_id = (int)$_GET["match_id"];
    if (empty($match_id) OR !is_numeric($match_id)){
        exit();
    }

    $match = new Live();
    $link = new Links();
    $teams = new Equipe();
    $ads = new Ads();


    $row = $match->getById($match_id);
    $ks_urls = null;
    $time_now  = time();
    $time_stop = (int)$row["Time_OFF"];
    $links = $link->getById($row["Custom_Link"]);

    if(empty($row) || $row["State_Match"] == 0) {
        //Todo: stop the page and show 404
        include "404.html";
        die();

    }

    if($time_now >= $time_stop){
        // Todo: Stop the match time up and show 404
        $match->stopLive($match_id);
        include "404.html";
        die();
    }


    // check if there a kora star link
    if(!empty($row['KS_URL'])){

        include "simple_html_dom.php";
        $ks_urls =  getLinksFromKS($row['KS_URL']);
    }


    // deal with twitch link and set mainLink
    if(!empty($ks_urls["twitch"])){

        $twitch_link = dealWithTwitch($ks_urls["twitch"],$row['KS_URL']);
        $mainLink = $twitch_link;

    }else if(!empty($ks_urls[0])){

        $mainLink = $ks_urls[0];
    }else{
        $mainLink = getMainLink($links);
    }

?>


<!doctype html>
<html lang="ar" dir="rtl">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@clappr/player@latest/dist/clappr.min.js"></script>
    <title>مشاهده  <?=getTeamsNames($row['Team_Host'],$row['Team_Gust'])?> </title>

    <?php
    // هنا سوف يظهر كود اعلان
    if($ads->getById(1)['Ads_Work']){
        include "Ads/Ads-Header.txt";
    }
    ?>
    <style>

        @font-face {
            font-family: 'icomoon';
            src:  url('../fonts/icomoon.eot?nwzg77');
            src:  url('../fonts/icomoon.eot?nwzg77#iefix') format('embedded-opentype'),
            url('../fonts/icomoon.ttf?nwzg77') format('truetype'),
            url('../fonts/icomoon.woff?nwzg77') format('woff'),
            url('../fonts/icomoon.svg?nwzg77#icomoon') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: block;
        }

        [class^="icon-"], [class*=" icon-"] {
            /* use !important to prevent issues with browser extensions that change fonts */
            font-family: 'icomoon' !important;
            speak: never;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;

            /* Better Font Rendering =========== */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .icon-sync-alt-solid:before {
            content: "\e900";
        }


        @font-face{
            font-family:bts;
            font-weight:300;
            src:url(../fonts/Bahij_TheSansArabic-Plain.ttf)
        }
        @font-face{
            font-family:bts;
            font-weight:500;
            src:url(../fonts/Bahij_TheSansArabic-Bold.ttf)
        }
        @font-face{
            font-family:bts;
            font-weight:700;
            src:url(../fonts/Bahij_TheSansArabic-Black.ttf)
        }

        *{
            font-family: "bts" ;

        }
        .my-thumbnail {
            padding: .25rem;
            background-color: #c5c5c5;
            border: 4px solid #dee2e6;
            border-radius: 0.25rem;
            max-width: 100%;
            height: auto;
        }
        .overlay {
            position: fixed;
            z-index: 10;
            padding-right: 100px;
            padding-top: 20px;
        }

        .i3contenair{
            width: 100%;
            height: 100%;
            position:absolute;
            z-index:1;
        }
        .i3contenair .ad_header{background:#999;padding:0;text-align:center;color:#fff;font-size:12px;font-weight:bold;width:auto; margin: 0 auto;}
        .i3contenair .ad_content{width:340px;height:auto;text-align:center;rgba(255,255,255,0.1); margin: 0 auto;}
        .i3contenair .ad_footer{position: absolute; top: 80px;}

        <?php if($mainLink == $ks_urls[0]): ?>
        #thum {
            height: 467px;
        }
        <?php endif; ?>
    </style>
</head>
<body class="bg-light">

<?php
// هنا سوف يظهر كود اعلان
if($ads->getById(3)['Ads_Work']){
    include "Ads/Ads-Body.txt";
}
?>

<div class="container">
    <div class="row">

        <div class="col-lg-3 offset-lg-1   d-none d-lg-block   ">
            <div class="text-center  mt-5 pt-5">
                <img src="../image/Ads600.jpg" alt="">
            </div>
        </div>

        <div class="col-lg-5">
            <div class="mt-4"></div>



            <H4 class="text-center"><?=getTeamsNames($row['Team_Host'],$row['Team_Gust'])?> </H4>



            <div class="pt-4"></div>

            <div class="ads-top">
                <div class="text-center">
                    <img src="../image/Ads250.jpg" alt="">
                </div>

            </div>
            <div class="text-center">

                <div class="p-2 mt-2 text-dark h5"> سيرفرات المشاهده </div>

                <?php if(!empty($ks_urls) && !empty($ks_urls["twitch"])): ?>
                    <button type="button" id="bt0" class="btn btn-primary">تويتش</button>
                <?php endif; ?>

                <?php if(!empty($links['Link1'])): ?>
                <button type="button" id="bt1" class="btn btn-primary ">سيرفر1</button>
                <?php endif; ?>

                <?php if(!empty($links['Link2'])): ?>
                <button type="button" id="bt2" class="btn btn-primary">سيرفر2</button>
                <?php endif; ?>

                <?php if(!empty($links['Link3'])): ?>
                <button type="button" id="bt3" class="btn btn-primary">سيرفر3</button>
                <?php endif; ?>

                <?php if(!empty($ks_urls) && !empty($ks_urls[0])): ?>
                    <button type="button" id="bt4" class="btn btn-primary">أحتياطي</button>
                <?php endif; ?>

            </div>

            <div class="mt-4"></div>

            <div class="text-center" >

                <?php if($row['Center_Ad']): ?>
                <div class=" ad-on-live i3contenair" id="i3contenair">
                    <div class="ad_content" id="ad_content">
                        <img src="../image/Ads250.jpg">
                        <div class="ad_footer" id="ad_footer">
                            <a href="#" id="hid"><img border="0" src="https://www.freeiconspng.com/thumbs/close-icon/close-icon-30.png" height="20px" width="60px" style="padding-right:40px" /></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="embed-responsive embed-responsive-16by9 p-4 my-thumbnail" id="thum">
                    <iframe class="embed-responsive-item" src="<?=$mainLink?>" scrolling="no" allowfullscreen></iframe>
                </div>

                <div class="mt-3"></div>
                <a href="" class="btn btn-info">  في حال توقف البث أضغط هنا لتحديث <span class="icon-sync-alt-solid"></span> </a>

            </div>


            <div class="mt-4"></div>

            <div class="ads-down pt-2">
                <div class="text-center">
                    <img src="../image/Ads250.jpg" alt="">
                </div>
            </div>

        </div>
        <div class="col-lg-2 offset-lg-1  d-none d-lg-block ">
            <div class="text-center mt-5 pt-5">
                <img src="../image/Ads600.jpg" alt="">
            </div>
        </div>
    </div>


</div>

<?php
// هنا سوف يظهر كود اعلان
if($ads->getById(2)['Ads_Work']){
    include "Ads/Ads-Footer.txt";
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>

    <?php if(!empty($ks_urls) && !empty($ks_urls["twitch"])): ?>
    // if button 1 cliked
    $( "#bt0" ).click(function() {
        $("button").removeClass("active");
        $("#bt0").addClass("active");
        $("#thum").css("height", "");
        $("iframe").attr("src","<?=$twitch_link?>");
    });
    <?php endif; ?>

    <?php if(!empty($links['Link1'])): ?>
    // if button 1 cliked
    $( "#bt1" ).click(function() {
        $("button").removeClass("active");
        $("#bt1").addClass("active");
        $("#thum").css("height", "");
        $("iframe").attr("src","<?=$links['Link1']?>");
    });
    <?php endif; ?>


    <?php if(!empty($links['Link2'])): ?>
    // if button 2 cliked
    $( "#bt2" ).click(function() {
        $("button").removeClass("active");
        $("#bt2").addClass("active");
        $("#thum").css("height", "");
        $("iframe").attr("src","<?=$links['Link2']?>");
    });
    <?php endif; ?>

    <?php if(!empty($links['Link3'])): ?>
    // if button 2 cliked
    $( "#bt3" ).click(function() {
        $("button").removeClass("active");
        $("#bt3").addClass("active");
        $("#thum").css("height", "");
        // $("#thum").css("height", "467px");
        $("iframe").attr("src","<?=$links['Link3']?>");
    });
    <?php endif; ?>

    <?php if(!empty($ks_urls) && !empty($ks_urls[0])): ?>
    // if button 1 cliked
    $( "#bt4" ).click(function() {
        $("button").removeClass("active");
        $("#bt4").addClass("active");
        $("#thum").css("height", "467px");
        $("iframe").attr("src","<?=$ks_urls[0]?>");
    });
    <?php endif; ?>

    $( "#hid" ).click(function(){
        $( "#i3contenair" ).hide();
    });
</script>
</body>



</html>
<?php } ?>