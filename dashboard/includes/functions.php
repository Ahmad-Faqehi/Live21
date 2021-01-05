<?php
function returnJSON(array $f) {
    /*
        Usage:
        returnJSON(array(params));
    */
    if(!is_array($f)){ exit; }

    header('Content-Type: application/json');

    exit(json_encode($f));

}

function generateNewString($len = 10){
    $token = "pOiuZtrEWQasDfGhjklmnBvCxy1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0, $len);

    return $token;
}

?>