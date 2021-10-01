<?php
$host = "localhost";
$user = "root";
$pw = "root";
$database="fun";

$con = new mysqli($host,$user,$pw,$database);

if($con->connect_errno){
    printf("Connection failed: %s\n", $con->connect_error);
    exit();
}
?>