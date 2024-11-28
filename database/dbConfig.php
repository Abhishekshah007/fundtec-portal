<?php
$host = "localhost";
$username = "admin";
$password = "admin";
$dbname = "fundtec_portal_db";

$conn = mysqli_connect($host,$username,$password,$dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
