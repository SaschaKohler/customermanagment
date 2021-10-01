<?php

session_start();
include('login.inc.php'); ?>
    <?php
    $sql = "SELECT * FROM customer where user_id = ( SELECT id from users where username = ?)";
    $query = $con->prepare($sql);
    $query->bind_param("s", $_SESSION['username']);
    $query->execute();
    $result = $query->get_result(); ?>
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



