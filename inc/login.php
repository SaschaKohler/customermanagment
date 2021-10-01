<?php
require_once('login.inc.php');
session_start();

if (!empty($_POST)) {

    $message = '';
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    if (!empty($username) && !empty($password)) {
        if (!($query = $con->prepare("SELECT username, password_hashed FROM users where username =?"))) {
            $message .= "<p>" . $con->error . "</p>";
        }
        if (!$query->bind_param("s", $username)) {
            echo "<p>" . $query->error . "</p>";
        }
        if (!$query->execute()) {
            echo "<p>" . $query->error . "</p>";
        }

        $result = $query->get_result();

        if (($result->num_rows == 1) && ($row = $result->fetch_assoc())) {
            if (password_verify($password, $row['password_hashed'])) {
                $_SESSION['username'] = $username;
                $fun = array('success' => 1 , 'message' => 'Login successful');
                echo json_encode(array('success' => 1 , 'message' => 'Login successful' ));

            } else {
                $message .= "wrong username or password";
                echo json_encode(array('success' => 0 , 'message' => $message));
            }
        } else {
            $message .=  "no users found with those credentials";
            echo json_encode(array('success' => 0 , 'message' => $message));

        }
    } else {

        $message .= "Please, provide username and password";
        echo json_encode(array('success' => 0, 'message' => $message));
    }

}

