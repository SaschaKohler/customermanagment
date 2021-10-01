<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Projekt</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/customerLogic.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>
<?php session_start();

include('inc/login.inc.php');
include('modal/modalTemplates.php');
include('inc/functions.php'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid justify-content-end">
        <a class="navbar-brand">Customer Ticket 2021</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (!isset($_SESSION['username'])) { ?>
                <button class="btn btn-success me-auto" data-bs-toggle="modal" data-bs-target="#loginModal"
                        type="submit">
                    Login
                </button>
                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"
                   class="link-dark ms-sm-2 me-sm-2">Register</a>
            <?php } else { ?>
                <span class="ms-sm-2 fw-bolder text-white">Hello <em><?php echo $_SESSION['username'] ?></em></span>
                <a href="#" class="btn-link link-dark ms-sm-3 d-inline-block" data-bs-toggle="modal"
                   data-bs-target="#profileModal">Profile</a>
                <a href="inc/logout.php" class="btn-link link-dark ms-lg-3 d-inline-block">Logout</a>
            <?php } ?>
        </div>
    </div>
</nav>

<?= modal_loginModal() ?>
<?= modal_registerModal() ?>
<?= modal_editCustomerModal() ?>
<?= modal_addCustomerModal() ?>
<?= modal_deleteCustomerModal() ?>

<div id="profileModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm" method="post">
                    <div class="form-message" style="display:none;"></div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="firstName" id="firstName"
                               value="<?php echo $entry['firstname'] ?>">
                        <label for="firstName" class="form-label">First Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="lastName" id="lastName"
                               value="<?php echo $entry['lastname'] ?>">
                        <label for="lastName" class="form-label">Last Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email"
                               value="<?php echo $entry['email'] ?>">
                        <label for="email" class="form-label">email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="oldPassword">
                        <label for="old_password" class="form-label">old password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password">
                        <label for="new_password" class="form-label">new password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password2">
                        <label for="new_password2" class="form-label">new password (repeat)</label>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="updateProfileModalButton">Update</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>

            </div>
            </form>

        </div>
    </div>
</div>

<?php if ($_SESSION['username']) {

    $sql = "SELECT * FROM customer where user_id = ( SELECT id from users where username = ?)";
    $query = $con->prepare($sql);
    $query->bind_param("s", $_SESSION['username']);
    $query->execute();
    $result = $query->get_result(); ?>

    <div class="container" id="main">
        <div class="messages"></div>

        <table class="table" id="customerTable">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">branding</th>
                <th scope="col">address</th>
                <th scope="col">phone</th>
                <th scope="col">updated at</th>
                <th scope="col">created at</th>
                <th scope="col">action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($entry = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $entry['id'] ?></td>
                    <td><?php echo $entry['branding'] ?></td>
                    <td><?php echo $entry['address'] ?></td>
                    <td><?php echo $entry['phone'] ?></td>
                    <td><?php echo $entry['updated_at'] ?></td>
                    <td><?php echo $entry['created_at'] ?></td>
                    <td>
                        <button class="btn btn-primary edit-data-button" data-bs-toggle="modal"
                                data-bs-target="#editCustomerModal" id="<?php echo $entry['id'] ?>">Edit
                        </button>
                        <button class="btn btn-danger delete-data-button" data-bs-target="#deleteCustomerModal"
                                data-bs-toggle="modal" id="<?php echo $entry['id'] ?>">Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <button class="btn btn-primary" data-bs-target="#addCustomerModal" data-bs-toggle="modal">add Customer</button>
    </div>
<?php } ?>


<div class="container" id="allInsertions">
    <div class="p-5" id="brandingTable">
        <h3>All Insertions</h3>

        <div class="container mb-3 d-flex flex-row flex-wrap justify-content-around">
        <?php

        $result = $con->query("SELECT * FROM customer order by user_id");

        while ($entry = $result->fetch_assoc()) { ?>

        <div class="card mt-5 shadow-sm" style="width:400px" >
            <div class="card-header"><?php echo $entry['branding'] ?></div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $entry['branding'] ?></h5>
                <h5 class="card-subtitle"><?php echo $entry['address'] ?> / </h5>
                <p class="card-text lh-sm">This is a possible space for special branding description</p>
            </div>
            <?php $query = $con->prepare('Select username from users where id =?');
            $query->bind_param("i", $entry['user_id']);
            $query->execute();
            $owner = $query->get_result()->fetch_assoc(); ?>
            <div class="card-footer"><p>Introduced by: <?php echo $owner['username'] ?></p></div>

        </div>
        <?php } ?>
        </div>
    </div>
</div>
</body>
</html>



