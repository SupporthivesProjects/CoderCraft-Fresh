<div class="modal-content">
    <div class="modal-header bg-primary">
        <h5 class="modal-title text-white">
            <i class="fas fa-plus-circle me-2"></i>
            Add New Currency
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <form class="form-horizontal" action="{{ route('currency.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row g-3">
                <!-- Currency Name -->
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" required>
                        <label for="name">Currency Name</label>
                    </div>
                </div>

                <!-- Symbol -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="symbol" name="symbol" required>
                        <label for="symbol">Symbol</label>
                    </div>
                </div>

                <!-- Code -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="code" name="code" required>
                        <label for="code">Currency Code</label>
                    </div>
                </div>

                <!-- Exchange Rate -->
                <div class="col-12">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="exchange_rate" name="exchange_rate" 
                               step="0.01" min="0" required>
                        <label for="exchange_rate">Exchange Rate (1 USD = ?)</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>
                Save Currency
            </button>
        </div>
    </form>
</div>
