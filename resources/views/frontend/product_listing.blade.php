@extends('frontend.layouts.app')

@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold text-primary mb-3">Shop Our Products</h1>
                    <p class="lead text-muted">Discover our wide range of digital products and services</p>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <form id="search-form" action="{{ route('search') }}" method="GET">
                                <div class="row g-3">
                                    <!-- Search Bar -->
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q"
                                                placeholder="Search products..." value="{{ request('q') }}">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Category Filter -->
                                    <div class="col-md-3">
                                        <select class="form-select" id="categorySelect" name="category">
                                            <option value="">All Categories</option>
                                            @foreach (\App\Models\Category::all() as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                                    {{ __($category->name) }}
                                                    ({{ $category->products ? count($category->products) : 0 }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Sort Filter -->
                                    <div class="col-md-3">
                                        <select class="form-select" id="sortSelect" name="sort_by">
                                            <option value="" {{ !request('sort_by') ? 'selected' : '' }}>Sort by
                                                Relevance</option>
                                            <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>
                                                Newest First</option>
                                            <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>
                                                Oldest First</option>
                                            <option value="price_low_to_high"
                                                {{ request('sort_by') == 'price_low_to_high' ? 'selected' : '' }}>Price: Low
                                                to High</option>
                                            <option value="price_high_to_low"
                                                {{ request('sort_by') == 'price_high_to_low' ? 'selected' : '' }}>Price:
                                                High to Low</option>
                                        </select>
                                    </div>

                                    <!-- Apply Filters Button -->
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-primary w-100">Apply</button>
                                    </div>
                                </div>

                                <!-- Price Range Filter (Hidden) -->
                                @if (request('min_price') || request('max_price'))
                                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Filters & Results Count -->
            <div class="row mb-4">
                <div class="col-md-6">
                    @if (request('q') || request('category') || request('sort_by') || request('min_price') || request('max_price'))
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="text-muted">Active filters:</span>

                            @if (request('q'))
                                <span class="badge bg-primary rounded-pill">
                                    Search: {{ request('q') }}
                                    <a href="{{ route('search', array_merge(request()->except('q'), ['page' => 1])) }}"
                                        class="text-white ms-1">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                </span>
                            @endif

                            @if (request('category'))
                                <span class="badge bg-primary rounded-pill">
                                    Category: {{ \App\Models\Category::find(request('category'))->name }}
                                    <a href="{{ route('search', array_merge(request()->except('category'), ['page' => 1])) }}"
                                        class="text-white ms-1">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                </span>
                            @endif

                            @if (request('min_price') || request('max_price'))
                                <span class="badge bg-primary rounded-pill">
                                    Price: {{ request('min_price') ?? '0' }} - {{ request('max_price') ?? 'max' }}
                                    <a href="{{ route('search', array_merge(request()->except(['min_price', 'max_price']), ['page' => 1])) }}"
                                        class="text-white ms-1">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                </span>
                            @endif

                            <a href="{{ route('search') }}" class="btn btn-sm btn-outline-secondary">
                                Clear All
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-muted">
                        Showing {{ $products->count() }} of {{ $products->total() }} products
                    </p>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="col-md-3">
                <select class="form-select" id="categorySelect" name="category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ __($category->name) }} ({{ $category->products_count }})
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Products Grid -->
            @if ($products->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @foreach ($products as $key => $product)
                        <div class="col">
                            <div class="card h-100 product-card shadow-sm border-0 transition-hover">
                                <div class="position-relative">
                                    <a href="{{ route('product', $product->slug) }}">
                                        <img src="{{ asset($product->thumbnail_img) }}" class="card-img-top product-img"
                                            alt="{{ __($product->name) }}">
                                    </a>
                                    @if ($product->discount > 0)
                                        <div
                                            class="position-absolute top-0 end-0 bg-danger text-white m-2 px-2 py-1 rounded">
                                            {{ $product->discount_type == 'amount' ? currency_symbol() . $product->discount : $product->discount . '%' }}
                                            OFF
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    @if ($product->category_id)
                                        @php
                                            $category = \App\Models\Category::find($product->category_id);
                                        @endphp
                                        @if ($category)
                                            <div class="mb-2">
                                                <span class="badge bg-light text-primary">
                                                    {{ __($category->name) }}
                                                </span>
                                            </div>
                                        @endif
                                    @endif


                                    <h5 class="card-title product-title">
                                        <a href="{{ route('product', $product->slug) }}"
                                            class="text-decoration-none text-dark">
                                            {{ __($product->name) }}
                                        </a>
                                    </h5>

                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <div class="price-container">
                                            <span class="fw-bold text-primary fs-5">
                                                {{ currency_symbol() . bcdiv(home_discounted_base_price_formatted($product->id), 1, 2) }}
                                            </span>
                                            @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                <span class="text-decoration-line-through text-muted ms-2">
                                                    {{ currency_symbol() . bcdiv(home_base_price_formatted($product->id), 1, 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('product', $product->slug) }}"
                                            class="btn btn-outline-primary w-100">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-4x text-muted"></i>
                    </div>
                    <h3>No Products Found</h3>
                    <p class="text-muted">We couldn't find any products matching your criteria.</p>
                    <a href="{{ route('search') }}" class="btn btn-primary mt-3">
                        Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container-fluid bg-light py-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-3">Need Help Finding the Right Product?</h2>
                    <p class="lead">Our team is here to help you find the perfect solution for your needs. Get in touch
                        with us today!</p>
                    <a href="{{ route('contactus') }}" class="btn btn-primary btn-lg mt-3">
                        Contact Us <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('frontend/CodeCrafterInnovations/assets/media/contactIMG.png') }}"
                        alt="Contact Us" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form when select elements change
            document.getElementById('categorySelect').addEventListener('change', function() {
                document.getElementById('search-form').submit();
            });

            document.getElementById('sortSelect').addEventListener('change', function() {
                document.getElementById('search-form').submit();
            });

            // Add hover effect to product cards
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('shadow');
                });

                card.addEventListener('mouseleave', function() {
                    this.classList.remove('shadow');
                });
            });
        });

        function filter() {
            document.getElementById('search-form').submit();
        }

        function rangefilter(arg) {
            document.querySelector('input[name=min_price]').value = arg[0];
            document.querySelector('input[name=max_price]').value = arg[1];
            filter();
        }
    </script>
@endsection

@section('style')
    <style>
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-img {
            height: 200px;
            object-fit: contain;
            padding: 1rem;
            background-color: #f8f9fa;
        }

        .product-title {
            height: 50px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .transition-hover {
            transition: all 0.3s ease;
        }

        .page-link {
            color: var(--bs-primary);
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .badge {
            font-weight: 500;
        }
    </style>
@endsection
