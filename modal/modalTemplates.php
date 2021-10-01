<?php

function modal_editCustomerModal()
{
    echo <<< EOT
<div id="editCustomerModal" class="modal fade">
    <div class="modal-dialog rounded-2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit/Update Customer</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="customerForm" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id">
                    <div class="form-floating mb-lg-2">
                        <input type="text" class="form-control" name="phone" id="phone">
                        <label for="phone" class="form-label">phone</label>
                    </div>
                    <div class="form-floating mb-lg-2">
                        <input type="text" class="form-control" name="address" id="address">
                        <label for="address" class="form-label">address</label>
                    </div>
                    <div class="form-floating mb-lg-2">
                        <input type="text" class="form-control" name="branding" id="branding">
                        <label for="branding" class="form-label">branding</label>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="updateCustomer">Update</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>

            </div>
            </form>

        </div>
    </div>
</div>
EOT;
}

function modal_registerModal() {
    echo <<<EOT
<div id="registerModal" class="modal fade">
    <div class="modal-dialog rounded-2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  id="registerForm" method="post" enctype="multipart/form-data">
                <div class="form-message" style="display:none;"></div>
                    <div class="form-floating mb-lg-2">
                        <input type="text" class="form-control" name="username">
                        <label for="username" class="form-label">username</label>
                    </div>
                    <div class="form-floating mb-lg-2">
                        <input type="email" class="form-control" name="email">
                        <label for="email" class="form-label">email</label>
                    </div>
                    <div class="form-floating mb-lg-2">
                        <input type="password" class="form-control" name="password">
                        <label for="password" class="form-label">password</label>
                    </div>
                    <div class="form-floating mb-lg-2">
                        <input type="password" class="form-control" name="password2">
                        <label for="password2" class="form-label">password(repeat)</label>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="registerFormButton">Register</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>

            </div>
            </form>

        </div>
    </div>
</div>

EOT;

}

function modal_loginModal(){
    echo <<<EOT
<div id="loginModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           
                <form id="loginForm" method="post" enctype="multipart/form-data"> 
                 <div class="form-message" style="display:none;"></div>
                    <div class="form-floating mb-sm-2">
                        <input type="text" name="username" class="form-control">
                        <label for="username" class="form-label">Username</label>
                    </div>
                    <div class="form-floating mb-sm-2">
                        <input type="password" name="password" class="form-control">
                        <label for="password" class="form-label">Password</label>
                    </div>

            </div>
            <div class="modal-footer">

                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"
                   class="link-dark ms-sm-2">Register</a>
                <button type="submit" class="btn btn-primary" id="loginModalFormButton">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>

EOT;

}

function modal_addCustomerModal(){
    echo <<<EOT
<div id="addCustomerModal" class="modal fade">
    <div class="modal-dialog rounded-2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Customer</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="addCustomerForm" enctype="multipart/form-data">
                    <div class="form-floating mb-lg-2">
                        <input type="text" class="form-control" name="phoneNew" id="phoneNew">
                        <label for="phone" class="form-label">phone</label>
                    </div>
                    <div class="form-floating mb-lg-2">
                        <input type="text" class="form-control" name="addressNew" id="addressNew">
                        <label for="address" class="form-label">address</label>
                    </div>
                    <div class="form-floating mb-lg-2">
                        <input type="text" class="form-control" name="brandingNew" id="brandingNew">
                        <label for="branding" class="form-label">branding</label>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="addNewCustomerButton">Add new</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>

            </div>
            </form>

        </div>
    </div>
</div>

EOT;

}

function modal_deleteCustomerModal(){
    echo <<<EOT
<div id="deleteCustomerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>You really want to delete this Eintragung?</h5>
                <form id="deleteForm" method="post">
                    <input type="hidden" id="deleteId" name="deleteId">
                    <button class="btn btn-danger" type="submit" id="deleteButton" >Delete</button>
                    
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
            </div>
        </div>
    </div>
</div>

EOT;

}

