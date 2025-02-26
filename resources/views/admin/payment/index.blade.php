@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0 text-muted fw-bold">
            Dashboard → <span class="text-primary">Payment</span>
        </p>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
            + Add Payment
        </button>
    </div>

    <table id="payment-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Account Name</th>
                <th>Source</th>
                <th>Client Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Include Modal -->
@include('admin.payment.modal.payment-add')

<!-- Include Edit Payment Modal -->
@include('admin.payment.modal.payment-edit')

<script>
   $(document).ready(function() {
        let table = $('#payment-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.payment") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'amount', name: 'amount' },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function (data) {
                        let colorClass = '';
                        if (data.toLowerCase() === 'completed') colorClass = 'text-success';
                        else if (data.toLowerCase() === 'failed') colorClass = 'text-danger';
                        else if (data.toLowerCase() === 'pending') colorClass = 'text-warning';
                        return `<span class="${colorClass} fw-bold">${data}</span>`;
                    }
                },
                { data: 'account_name', name: 'account_name' },
                { data: 'source', name: 'source' },
                { data: 'client_name', name: 'client_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });


</script>
@endsection
