<?php
require_once ('login.inc.php');

if(!empty($_POST)) {

    $id = $_POST['id'];

    $output = '';
    $phone = mysqli_real_escape_string($con,$_POST['phone']);
    $address = mysqli_real_escape_string($con,$_POST['address']);
    $branding = mysqli_real_escape_string($con,$_POST['branding']);

    $sql = "Update customer set phone=?, address=?, branding=? where id=?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssi",$phone,$address,$branding,$id);

    $result = $stmt->execute();

    if($result) {
        $output .= include('../inc/customerTable.inc.php');

    }
    echo $output;

}