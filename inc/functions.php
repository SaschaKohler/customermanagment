<?php function getCustomers($username)
{
    $sql = "SELECT * FROM customer where user_id = ( SELECT id from users where username = ?)";
    $query = $con->prepare($sql);
    $query->bind_param("s", $_SESSION['username']);
    $query->execute();
    return $query->get_result();

}

