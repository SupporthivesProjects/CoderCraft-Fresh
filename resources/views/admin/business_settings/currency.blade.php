@extends('admin.layouts.adminHeader')

@section('content')
    <div class="col-9 container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="page-title">Currency Management</h2>
            </div>
        </div>

        <div class="row g-4">
            <!-- System Default Currency Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">System Default Currency</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('business_settings.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Select Default Currency</label>
                                <select class="form-select" name="system_default_currency">
                                    @foreach ($active_currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                            {{ \App\Models\BusinessSetting::where('type', 'system_default_currency')->first()->value == $currency->id ? 'selected' : '' }}>
                                            {{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="types[]" value="system_default_currency">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Currency Format Settings Card -->
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Currency Format Settings</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('business_settings.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Symbol Format</label>
                                <select class="form-select" name="symbol_format">
                                    <option value="1" @if (\App\Models\BusinessSetting::where('type', 'symbol_format')->first()->value == 1) selected @endif>
                                        [Symbol] [Amount]
                                    </option>
                                    <option value="2" @if (\App\Models\BusinessSetting::where('type', 'symbol_format')->first()->value == 2) selected @endif>
                                        [Amount] [Symbol]
                                    </option>
                                </select>
                                <input type="hidden" name="types[]" value="symbol_format">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Decimal Places</label>
                                <select class="form-select" name="no_of_decimals">
                                    <option value="0" @if (\App\Models\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 0) selected @endif>0</option>
                                    <option value="1" @if (\App\Models\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 1) selected @endif>1</option>
                                    <option value="2" @if (\App\Models\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 2) selected @endif>2</option>
                                    <option value="3" @if (\App\Models\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 3) selected @endif>3</option>
                                </select>
                                <input type="hidden" name="types[]" value="no_of_decimals">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Currency List Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Available Currencies</h5>
                        <button onclick="currency_modal()" class="btn btn-light">
                            <i class="fas fa-plus"></i> Add New Currency
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Currency Name</th>
                                        <th>Symbol</th>
                                        <th>Code</th>
                                        <th>Exchange Rate (1 USD =)</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currencies as $key => $currency)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $currency->name }}</td>
                                            <td>{{ $currency->symbol }}</td>
                                            <td>{{ $currency->code }}</td>
                                            <td>{{ $currency->exchange_rate }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        onchange="update_currency_status(this)" value="{{ $currency->id }}"
                                                        {{ $currency->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"
                                                    onclick="edit_currency_modal('{{ $currency->id }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted">
                                    Showing {{ $currencies->firstItem() }} to {{ $currencies->lastItem() }} of
                                    {{ $currencies->total() }} currencies
                                </div>

                                <div class="pagination-wrapper">
                                    {{ $currencies->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="add_currency_modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content"></div>
        </div>
    </div>

    <div class="modal fade" id="currency_modal_edit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function currency_modal() {
            $.get('{{ route('currency.create') }}', function(data) {
                $('#add_currency_modal .modal-content').html(data);
                $('#add_currency_modal').modal('show');
            });
        }

        function update_currency_status(el) {
            $.post('{{ route('currency.update_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: el.checked ? 1 : 0
            }, function(data) {
                if (data == 1) {
                    showAlert('success', 'Currency status updated successfully');
                } else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function edit_currency_modal(id) {
            $.post('{{ route('currency.edit') }}', {
                _token: '{{ csrf_token() }}',
                id: id
            }, function(data) {
                $('#currency_modal_edit .modal-content').html(data);
                $('#currency_modal_edit').modal('show');
            });
        }
    </script>
@endsection
