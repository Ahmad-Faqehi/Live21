<?php
include "simple_html_dom.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://bng.goalarab.com/bein1/");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$html = new simple_html_dom();
$html->load($response);

foreach($html->find("//script[type='text/javascript']") as $link){
    if (strpos($link->innertext, "var _foxpush") === false)
        $vla = $link->innertext  ;
}
$pattern = '~[a-z]+://\S+~';
if($num_found = preg_match_all($pattern, $vla, $out))
{

    $str = $out[0][0];
    $str = rtrim($str,"',");
    $str = rtrim($str,"'};");


}

echo $en = $str;


?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <iframe src="jw.php?u=<?php //echo $en ?>" frameborder="0"></iframe>
</body>
</html> -->