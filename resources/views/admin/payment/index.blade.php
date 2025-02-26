@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="container-fluid py-4">
    <p class="mb-4 text-muted fw-bold">
        Dashboard → <span class="text-primary">Payment</span>
    </p>

    <table id="payment-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Transaction Id</th>
                <th>Details</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#payment-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.payment") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'amount', name: 'amount' },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function (data, type, row) {
                        let colorClass = '';
                        if (data.toLowerCase() === 'completed') {
                            colorClass = 'text-success'; 
                        } else if (data.toLowerCase() === 'failed') {
                            colorClass = 'text-danger';
                        } else if (data.toLowerCase() === 'pending') {
                            colorClass = 'text-warning'; 
                        }
                        return `<span class="${colorClass} fw-bold">${data}</span>`;
                    }
                },
                { data: 'transaction_id', name: 'transaction_id' },
                { data: 'details', name: 'details' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });


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

    });
</script>
@endsection
