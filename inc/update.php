<?php
include('login.inc.php');
session_start();

if (!empty($_POST)) {

    $username = $_SESSION['username'];
    $firstName = trim(htmlspecialchars(($_POST['firstName'])));
    $lastName = trim(htmlspecialchars($_POST['lastName']));
    $email = trim(htmlspecialchars(($_POST['email'])));
    $oldPassword = trim(htmlspecialchars($_POST['oldPassword']));
    $password = trim(htmlspecialchars(($_POST['password'])));
    $password2 = trim(htmlspecialchars($_POST['password2']));

    $error = false;


    if(!empty($oldPassword) && !empty($password) && !empty($password2) ) {

        if($password == $password2) {

            $stmt = $con->prepare("Select password_hashed from users where username= ? AND email = ? ");
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();

            $result = $stmt->get_result();

            if(($result->num_rows == 1) && ($row = $result->fetch_assoc())) {
                if(password_verify($oldPassword,$row['password_hashed'])) {
                    $hash = password_hash($password,PASSWORD_DEFAULT);
                    $stmt = $con->prepare("Update users Set firstname = ? , lastname = ?, email=? , password_hashed =? where username=?");
                    $stmt->bind_param("sssss",$firstName,$lastName,$email,$hash,$username);
                    $stmt->execute();
                    $stmt->close();
                    $con->close();
                    echo json_encode(array('success' => 1 , 'message' => 'user password succesfully updated'));

                }
            }
        } else {
            echo json_encode(array('success' => 0, 'message' => 'repeat new password'));
            exit();
        }

    } elseif ( !empty($firstName) || !empty($lastName) )
    {
        $stmt = $con->prepare("UPDATE users Set firstname=? , lastname=? , email=? where username=? ");
        $stmt->bind_param("ssss",$firstName,$lastName,$email,$username);
        if(!$stmt->execute()) {
            $error = true;

        };
        $stmt->close();
        $con->close();

        if(!error) {
            echo json_encode(array('success' => 1 , 'message' => 'firstname/lastname successfully updated'));
        } else {
            echo json_encode(array('success' => 0 , 'message' => 'email already in database'));

        }

    } else {
        echo json_encode(array('success' => 0 , 'message' => 'some error occurred'));

    }





}

