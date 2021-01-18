<?php
//include "simple_html_dom.php";
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "https://ch.as-goal.site/p/page12.html");
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$response = curl_exec($ch);
//curl_close($ch);
//
//$html = new simple_html_dom();
//$html->load($response);
//
//$es = $html->find('div[class="servers-name"]', 0);
//$buttons = $es->innertext;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container">

    <div class="row">

    </div>

    <div class="embed-responsive embed-responsive-16by9 p-4 my-thumbnail" id="thum">
        <iframe class="embed-responsive-item" src="https://ch.as-goal.site/p/page11.html?m=1#tabs" height="150px" scrolling="no" allowfullscreen></iframe>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script>
    function dodajAktywne(a) {
    }
    function setURL(url){
        // document.getElementById('iframe').src = url;
        $("iframe").attr("src",url);
    }
</script>
</body>
</html>
