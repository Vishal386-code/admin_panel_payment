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
            url: '{{ route("admin.payment.store") }}',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    Swal.fire('Success!', response.message, 'success');
                    $('#addPaymentModal').modal('hide');
                    table.ajax.reload();
                    $('#paymentForm')[0].reset();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error!', 'Something went wrong!', 'error');
            }
        });
    });

        
    
});

