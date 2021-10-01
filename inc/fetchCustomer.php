<?php

include('login.inc.php');

if(isset($_POST['entry_id'])){

    $id = $_POST['entry_id'];
    $stmt = $con->prepare("SELECT * FROM  customer where id=?");
    $stmt->bind_param("i",$id);

    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode($result);



}
?>