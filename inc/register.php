<?php


require_once('login.inc.php');
session_start();

if (!empty($_POST)) {

    $message = '';
    $username = trim(htmlspecialchars(($_POST['username'])));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars(($_POST['password'])));
    $password2 = trim(htmlspecialchars(($_POST['password2'])));


    $error = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message .= 'provide a valid email';
        $error = true;
    }

    if (!$error) {
        if ($password != $password2) {
            $message .= "passwords are not equal";
            $error = true;
        }

        if (!($stmt = $con->prepare("SELECT * FROM users where email = ?"))) {
            $message .= '<p>' . $con->error . "</p>";
        }
        if (!$stmt->bind_param('s', $email)) {
            $message .= "<p>" . $stmt->error . "</p>";
        }
        if (!$stmt->execute()) {
            $message .= "<p>" . $stmt->error . "</p>";
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $message .= 'email already in database';
            $error = true;
        }
    }

    if (!$error) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        if (!($stmt = $con->prepare("INSERT INTO users (username , email , password_hashed) VALUES (?,?,?)"))) {
            $message .= "<p>" . $con->error . "</p>";
        }
        if (!$stmt->bind_param("sss", $username, $email, $hash)) {
            $message .= "<p>" . $stmt->error . "</p>";
        }
        if (!$stmt->execute()) {
            $message .= "<p>" . $stmt->error . "</p>";
        }
        $stmt->close();
        $con->close();

        $_SESSION['username'] = $username;
        echo json_encode((array('success' => 1 , 'message' => 'User created')));
    } else {
        echo json_encode(array('success' => 0 , 'message' => $message));
    }

}
