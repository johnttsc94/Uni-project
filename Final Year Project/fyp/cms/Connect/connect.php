<?php

// request database
$server = 'localhost'; // Server
$userName = 'root'; // Username
$password = ''; // Password
$database = 'system_fyp'; // Database name

$mysqli = new mysqli($server, $userName, $password, $database) ; // Connect to database
$mysqli->set_charset("utf8");

date_default_timezone_set('Asia/Kuala_Lumpur') ;

// Check connection //
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", mysqli_connect_error()) ;
    exit ;
}
?>