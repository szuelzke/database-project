<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "logintest";

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if($db === false){
    die("Error: connection error, " . mysqli_connect_error());
}
?>