<div class="modal fade" id="editPaymentModal" tabindex="-1" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPaymentForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editPaymentId" name="id">
                    
                    <div class="mb-3">
                        <label for="editAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="editAmount" name="amount" required>
                    </div>

                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editAccountName" class="form-label">Account Name</label>
                        <input type="text" class="form-control" id="editAccountName" name="account_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="editSource" class="form-label">Source</label>
                        <input type="text" class="form-control" id="editSource" name="source" required>
                    </div>

                    <div class="mb-3">
                        <label for="editClientName" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="editClientName" name="client_name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>
