@extends('admin.layouts.adminHeader')

@section('content')
    <style>
        .pagination-wrapper {
            display: flex !important;
            justify-content: flex-end !important;
        }

        .pagination-wrapper nav {
            display: block !important;
            width: auto !important;
        }

        .pagination-wrapper .flex.justify-between.flex-1 {
            display: none !important;
        }

        .pagination-wrapper .flex.items-center.justify-between {
            display: flex !important;
            gap: 8px !important;
        }

        .pagination-wrapper button,
        .pagination-wrapper span,
        .pagination-wrapper a {
            display: inline-flex !important;
            align-items: center !important;
            padding: 8px 12px !important;
            margin: 0 2px !important;
            border-radius: 4px !important;
            background: #fff !important;
            color: #6c757d !important;
            border: 1px solid #dee2e6 !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            text-decoration: none !important;
        }

        .pagination-wrapper span[aria-current="page"] {
            background: #4e73df !important;
            color: white !important;
            border-color: #4e73df !important;
        }

        .pagination-wrapper a:hover {
            background: #e9ecef !important;
            color: #4e73df !important;
            border-color: #dee2e6 !important;
        }

        .pagination-wrapper svg {
            width: 20px !important;
            height: 20px !important;
        }

        .pagination-wrapper p.text-sm.text-gray-700.leading-5 {
            display: none !important;
        }
    </style>

    <div class="col-md-9">
        <div class="container-fluid px-4">
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h2 class="page-title">System Logs</h2>
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" data-filter="all">All Logs</button>
                        <button class="btn btn-outline-primary" data-filter="admin">Admin Logs</button>
                        <button class="btn btn-outline-primary" data-filter="main">Main Logs</button>
                    </div>
                    <div class="date-filter">
                        <select class="form-select" onchange="window.location.href='?date=' + this.value">
                            @foreach ($logDates as $date)
                                <option value="{{ $date }}" {{ $date == $selectedDate ? 'selected' : '' }}>
                                    {{ $date }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="logsTable">
                        <thead class="table-light">
                            <tr>
                                <th>Timestamp</th>
                                <th>Source</th>
                                <th>Level</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paginatedLogs as $log)
                                <tr class="log-entry {{ $log['level'] === 'ERROR' ? 'table-danger' : '' }}"
                                    data-source="{{ $log['source'] }}">
                                    <td>{{ $log['timestamp'] }}</td>
                                    <td>
                                        <span class="badge bg-{{ $log['source'] === 'admin' ? 'purple' : 'primary' }}">
                                            {{ ucfirst($log['source']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $log['level'] === 'ERROR' ? 'danger' : 'info' }}">
                                            {{ $log['level'] }}
                                        </span>
                                    </td>
                                    <td>{{ $log['message'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Showing {{ $paginatedLogs->firstItem() }} to {{ $paginatedLogs->lastItem() }} of
                {{ $paginatedLogs->total() }}
                logs
            </div>
            <div class="pagination-wrapper">
                {{ $paginatedLogs->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('[data-filter]');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.dataset.filter;
                    const rows = document.querySelectorAll('.log-entry');

                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    rows.forEach(row => {
                        if (filter === 'all' || row.dataset.source === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection
