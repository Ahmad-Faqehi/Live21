<?php
include "../includes/require.php";
include "../includes/Database.php";

$match = new User();

print_r($match->getById(4));

