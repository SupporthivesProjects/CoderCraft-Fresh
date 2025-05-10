@extends('admin.layouts.adminHeader')

@section('content')
    <!-- Main Content -->
    <div class="col-md-9 admin-content">
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stats-info">
                        <h4>Total Products</h4>
                        <p>{{ \App\Models\Product::getPublishedProducts() }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-info">
                        <h4>Total Users</h4>
                        <p>{{ \App\Models\User::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stats-info">
                        <h4>Total Orders</h4>
                        <p>{{ \App\Models\Order::count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>User Management</h4>
                        <span class="badge bg-primary">Total Users: {{ \App\Models\User::count() }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\User::latest()->get() as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->user_type }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    data-user-id="{{ $user->id }}"
                                                    {{ $user->is_active ? 'checked' : '' }}
                                                    onchange="toggleUserStatus(this)">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function toggleUserStatus(element) {
            const userId = element.dataset.userId;
            fetch(`/admin/users/${userId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showFrontendAlert('success', 'User status updated successfully');
                    }
                });
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch(`/admin/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    });
            }
        }
    </script>
@endsection
