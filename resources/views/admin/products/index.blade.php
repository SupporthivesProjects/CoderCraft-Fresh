@extends('admin.layouts.adminHeader')

@section('content')
<div class="col container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">{{ __($type.' Products') }}</h2>
        @if($type != 'Seller')
            <a href="{{ route('products.create')}}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Add New Product
            </a>
        @endif
    </div>

    <!-- Filters Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form id="sort_products" action="" method="GET">
                <div class="row align-items-center">
                    @if($type == 'Seller')
                        <div class="col-md-4">
                            <select class="form-select" id="user_id" name="user_id" onchange="sort_products()">
                                <option value="">All Sellers</option>
                                @foreach (App\Seller::all() as $seller)
                                    @if ($seller->user && $seller->user->shop)
                                        <option value="{{ $seller->user->id }}" 
                                            {{ $seller->user->id == $seller_id ? 'selected' : '' }}>
                                            {{ $seller->user->shop->name }} ({{ $seller->user->name }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-md-4">
                        <select class="form-select" name="type" id="type" onchange="sort_products()">
                            <option value="">Sort by</option>
                            <option value="rating,desc">Rating (High > Low)</option>
                            <option value="rating,asc">Rating (Low > High)</option>
                            <option value="num_of_sale,desc">Sales (High > Low)</option>
                            <option value="num_of_sale,asc">Sales (Low > High)</option>
                            <option value="unit_price,desc">Price (High > Low)</option>
                            <option value="unit_price,asc">Price (Low > High)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" name="search" 
                                placeholder="Search products..." value="{{ $sort_search ?? '' }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            @if($type == 'Seller')
                                <th>Seller</th>
                            @endif
                            <th>Sales</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                            <tr>
                                <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($product->thumbnail_img)}}" 
                                             class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover"
                                             alt="{{ $product->name }}">
                                        <div>
                                            <h6 class="mb-0">{{ $product->name }}</h6>
                                            <small class="text-muted">{{ $product->code }}</small>
                                        </div>
                                    </div>
                                </td>
                                @if($type == 'Seller')
                                    <td>{{ $product->user->name }}</td>
                                @endif
                                <td>
                                    <span class="badge bg-success">{{ $product->num_of_sale }}</span>
                                </td>
                                <td>{{ $product->current_stock }}</td>
                                <td>${{ number_format($product->unit_price, 2) }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               onchange="update_published(this)"
                                               value="{{ $product->id }}" 
                                               {{ $product->published ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" 
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('products.admin.edit', $product->id) }}">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" 
                                                   onclick="deleteProduct({{ $product->id }})">
                                                    <i class="fas fa-trash me-2"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} 
                    of {{ $products->total() }} products
                </div>
                <div class="pagination-wrapper">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    {{-- <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Todays Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_products(el){
            $('#sort_products').submit();
        }

    </script> --}}
@endsection
