<?php

require_once ('login.inc.php');

if(!empty($_POST)) {

    $output = '';
    $id = $_POST['deleteId'];

    $sql = "Delete From customer where id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i",$id);

    $result = $stmt->execute();

    if($result){
        $output .= include('../inc/customerTable.inc.php');
    }
    echo $output;
}