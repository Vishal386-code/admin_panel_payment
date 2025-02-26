/* resources\views\profile\show.blade.php */
$(document).ready(function() {
    $(".toggle-btn").click(function() {
        $(".form-box").addClass("hidden");
        $(".toggle-btn").removeClass("active");
        $($(this).data("target")).removeClass("hidden");
        $(this).addClass("active");
    });

/*views\admin\payment\index.blade.php*/

    

     // Delete Button Click Event with SweetAlert2
     $(document).on('click', '.delete-btn', function () {
        let paymentId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/payment/${paymentId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');
                            $("#payment-table").DataTable().ajax.reload();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong!', 'error');
                    }
                });
            }
        });
    });
    //  Form Submit AJAX Request
    $('#paymentForm').on('submit', function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: `/dashboard/payment/store`,
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    Swal.fire('Success!', response.message, 'success');
                    $('#addPaymentModal').modal('hide');
                    // table.ajax.reload();
                    $("#payment-table").DataTable().ajax.reload();
                    $('#paymentForm')[0].reset();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error!1', 'Something went wrong!', 'error');
            }
        });
    });
    
    // edit modal form show
    $(document).on('click', '.edit-btn', function () {
        let paymentId = $(this).data('id');

        $.ajax({
            url: `/payments/${paymentId}/edit`,
            type: 'GET',
            success: function (data) {
                $('#editPaymentId').val(data.id);
                $('#editAmount').val(data.amount);
                $('#editStatus').val(data.status);
                $('#editAccountName').val(data.account_name);
                $('#editSource').val(data.source);
                $('#editClientName').val(data.client_name);

                $('#editPaymentModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Error fetching payment details. Please try again.',
                });
                console.error(xhr.responseText);
            }
        });
    });

    // Update Payment
    $('#editPaymentForm').on('submit', function (e) {
        e.preventDefault();
        
        let paymentId = $('#editPaymentId').val();
        let formData = $(this).serialize();

        $.ajax({
            url: `/payments/${paymentId}`,
            type: 'PUT',
            data: formData,
            success: function (response) {
                $('#editPaymentModal').modal('hide');

                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                table.ajax.reload();
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'Error updating payment. Please check your inputs.',
                });
                console.error(xhr.responseText);
            }
        });
    });


    // Reset Modal Form on Close
    $('#editPaymentModal').on('hidden.bs.modal', function () {
        $('#editPaymentForm')[0].reset();
    });
    
});

