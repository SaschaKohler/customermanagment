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
            $('#customerTable').html(data);
        }
    });
});