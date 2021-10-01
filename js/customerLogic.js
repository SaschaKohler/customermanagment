$(document).on('click' , '#addNewCustomerButton', function(e) {
    e.preventDefault();
    var form = $('#addCustomerForm')[0];
    var formData = new FormData(form);
    console.log(Object.fromEntries(formData));

    $.ajax ({
        url: 'inc/addCustomer.php',
        type: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        dataType: 'html',
        success: function(data){
            $('#addCustomerForm')[0].reset();
            $('#addCustomerModal').modal('hide');
            $('#main').html(data);
        }
    });
});

$(document).on('click', '.delete-data-button', function () {
    var entry_id = $(this).attr("id");
    console.log(entry_id);
    $.ajax({
        url: "inc/fetchCustomer.php",
        method: "POST",
        data: {
            entry_id: entry_id
        },
        dataType: 'json',
        success: function (data) {
            $('#deleteId').val(data.id);
        },
        error: function(req, err){
            console.log('my message ' + err);
        }
    });
});

$(document).on('click','#deleteButton',function(e) {
    e.preventDefault();
    $.ajax({
        url: 'inc/delete.php',
        type:'POST',
        data: $('#deleteForm').serialize(),
        success: function(data){
            $('#deleteCustomerModal').modal('hide');
            $('#customerTable').html(data);
        }
    });
});



$(document).on('click', '.edit-data-button', function () {
    var entry_id = $(this).attr("id");

    $.ajax({
        url: "inc/fetchCustomer.php",
        method: "POST",
        data: {
            entry_id: entry_id
        },
        dataType: 'json',
        success: function (data) {
            $('#id').val(data.id);
            $('#phone').val(data.phone);
            $('#address').val(data.address);
            $('#branding').val(data.branding);
        },
        error: function(req, err){
            console.log('my message ' + err);
        }
    });
});

$(document).on('click','#updateProfileModalButton',function (e) {
    e.preventDefault();
    var form = $('#profileForm')[0];
    var formData = new FormData(form);
    console.log(Object.fromEntries(formData));

    $.ajax({
        url: 'inc/update.php',
        type: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        processData: false,
        contentType:false,
        datatype: 'html',
        success: function(data){
            var jsonData = JSON.parse(data);
            if(jsonData.success == '1'){
                $('#profileModal').modal('hide');
                $('#profileForm .form-message').empty();

                $('#profileForm')[0].reset();

                $('.messages').append('<span class="success alert-success d-inline-block">'+jsonData.message+'</span>');
                $('.messages').slideToggle(300);

                window.setTimeout(function closeModal() {
                    $('.messages').slideToggle(300);
                }, 5000 );

                location.href = 'index.php';
            }
            else {
                $('#profileForm .form-message').append('<span class="alert alert-danger d-inline-block">'+jsonData.message+'</span>');
                $('#profileForm .form-message').slideToggle(300);

                window.setTimeout(function closeModal() {
                    $('#profileForm .form-message').slideToggle(300);
                    $('#profileModal').modal('hide');
                    $('#profileForm .form-message').empty();
                }, 3000 );
                $('#profileForm')[0].reset();

                //location.href = '../index.php';
            }
        }
    });
});


$(document).on('click', '#loginModalFormButton', function(e) {
    e.preventDefault();
    var form = $('#loginForm')[0];
    var formData = new FormData(form);

    $.ajax({
        url: 'inc/login.php',
        type: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        dataType: 'html',
        success: function(data){
            var jsonData = JSON.parse(data);
            if(jsonData.success == "1"){
                $('#loginModal').modal('hide');
                $('#loginForm .form-message').empty();

                $('#loginForm')[0].reset();

                $('.messages').append('<span class="success alert-success d-inline-block">'+jsonData.message+'</span>');
                $('.messages').slideToggle(300);

                window.setTimeout(function closeModal() {
                    $('.messages').slideToggle(300);
                }, 5000 );

              //  console.log(jsonData.html);
                location.href = 'index.php';
                $('.messages').append('<span class="success alert-success d-inline-block">'+jsonData.message+'</span>');

            }
            else {
                $('#loginForm .form-message').append('<span class="alert alert-danger d-inline-block">'+jsonData.message+'</span>');
                $('#loginForm .form-message').slideToggle(300);
                $('#loginForm')[0].reset();

                /*
                window.setTimeout(function closeModal() {
                    $('#loginForm .form-message').slideToggle(300);
                    $('#loginModal').modal('hide');
                    $('#loginForm .form-message').empty();
                }, 3000 );
*/
                //location.href = '../index.php';
            }
        }
    });
});

$(document).on('click','#registerFormButton', function(e) {
    e.preventDefault();
    var form = $('#registerForm')[0];
    var formData = new FormData(form);
    console.log(Object.fromEntries(formData));

    $.ajax({
        url: 'inc/register.php',
        type: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        dataType: 'html',
        success: function(data){
            var jsonData = JSON.parse(data);
            if(jsonData.success == "1"){
                $('#registerModal').modal('hide');
                $('.form-message').empty();

                $('#registerForm')[0].reset();

                $('.messages').append('<span class="success alert-success d-inline-block">'+jsonData.message+'</span>');
                $('.messages').slideToggle(300);

                window.setTimeout(function closeModal() {
                    $('.messages').slideToggle(300);
                }, 5000 );

                location.href = 'index.php';
            }
            else {
                $('.form-message').append('<span class="alert alert-danger d-inline-block">'+jsonData.message+'</span>');
                $('.form-message').slideToggle(300);

                window.setTimeout(function closeModal() {
                    $('.form-message').slideToggle(300);
                    $('#registerModal').modal('hide');
                    $('.form-message').empty();
                }, 3000 );
                $('#registerForm')[0].reset();

                //location.href = '../index.php';
            }
        }
    });
});

$(document).on('click', '#updateCustomer', function(e) {
    e.preventDefault();
    var form = $('#customerForm')[0];
    var formData = new FormData(form);


    if ($('#branding').val() == "") {
        alert("Branding name is required");
    } else if ($('#address').val() == '') {
        alert("Please provide an address");
    } else if ($('#phone').val() == '') {
        alert("Please provide a phone number");
    } else
    {
        $.ajax({
            url: 'inc/updateCustomer.php',
            type: 'POST',
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            dataType: 'html',
            success: function (data) {
                $('#editCustomerModal').modal('hide');
                $('#customerTable').html(data);

            }
        });
    }
});


