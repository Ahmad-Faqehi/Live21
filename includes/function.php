<?php
if(count(get_included_files()) == 1){
    header('HTTP/1.0 403 Forbidden');
    exit;
}

echo  "Hello";