<?php


require_once ('login.inc.php');

session_start();

if(!empty($_POST)){

    $stmt = $con->prepare("Select id from users where username = ?");
    $stmt->bind_param("s", $_SESSION['username']);

    $stmt->execute();

    $entry = $stmt->get_result()->fetch_assoc();

    $user_id = $entry['id'];



    $output = '';
    $phone = trim(htmlspecialchars($_POST['phoneNew']));
    $address = trim(htmlspecialchars($_POST['addressNew']));
    $branding = trim(htmlspecialchars($_POST['brandingNew']));

    $sql = "Insert into customer (user_id,phone,address,branding) VALUES( ?,?,?,?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("isss" ,$user_id,$phone,$address,$branding);

    $result = $stmt->execute();

       echo include('../inc/customerTable.inc.php');

}