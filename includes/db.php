<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ssarch";
    $port = 3308;
}

$con = new mysqli($host, $username, $password, $database, $port);

if ($con->connect_error) {
    echo $con->connect_error;
}
