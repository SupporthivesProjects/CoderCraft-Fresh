@extends('frontend.layouts.app')

@section('content')
<!-- Product Detail Section -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <!-- Main Product Image -->
                        <div class="product-main-image mb-3">
                            @php
                                $photos = json_decode($product->photos);
                                $mainPhoto = is_array($photos) && count($photos) > 0 ? $photos[0] : $product->thumbnail_img;
                            @endphp
                            <img src="{{ asset($mainPhoto) }}" 
                                class="img-fluid rounded" 
                                id="main-product-image" 
                                alt="{{ $product->name }}">
                        </div>
                        
                        <!-- Thumbnail Gallery -->
                        @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 1)
                            <div class="product-thumbnails d-flex flex-wrap justify-content-center">
                                @foreach(json_decode($product->photos) as $key => $photo)
                                    <div class="thumbnail-item mx-2 mb-2">
                                        <img src="{{ asset($photo) }}" 
                                            class="img-thumbnail product-thumbnail {{ $key == 0 ? 'active' : '' }}" 
                                            alt="Thumbnail {{ $key }}"
                                            onclick="changeMainImage('{{ asset($photo) }}', this)">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <!-- Product Category -->
                        @if($product->category_id)
                            @php
                                $category = \App\Models\Category::find($product->category_id);
                            @endphp
                            @if($category)
                                <div class="mb-2">
                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                </div>
                            @endif
                        @endif
                        
                        <!-- Product Title -->
                        <h1 class="product-title mb-3">{{ $product->name }}</h1>
                        
                        <!-- Product Price -->
                        <div class="product-price mb-4">
                            <span class="fs-3 fw-bold text-primary">
                                {{ currency_symbol() . bcdiv(home_price_formatted($product->id), 1, 2) }}
                            </span>
                            
                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                <span class="text-decoration-line-through text-muted ms-2">
                                    {{ currency_symbol() . bcdiv(home_base_price_formatted($product->id), 1, 2) }}
                                </span>
                                <span class="badge bg-danger ms-2">
                                    {{ $product->discount_type == 'amount' ? currency_symbol() . $product->discount : $product->discount . '%' }} OFF
                                </span>
                            @endif
                        </div>
                        
                        <!-- Product Description -->
                        <div class="product-description mb-4">
                            <h5 class="fw-bold mb-3">Description</h5>
                            <div class="description-content">
                                {!! str_limit(strip_tags(htmlspecialchars_decode($product->description)), 400) !!}
                                
                                @if(strlen(strip_tags(htmlspecialchars_decode($product->description))) > 400)
                                    <a href="#full-description" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#descriptionModal">
                                        Read More
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Product Options Form -->
                        <form id="option-choice-form" class="mb-4">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            
                            <!-- Quantity Selector -->
                            <div class="form-group mb-4">
                                <label for="quantity" class="form-label fw-bold">Quantity</label>
                                <div class="input-group quantity-selector">
                                    <button type="button" class="btn btn-outline-secondary" id="minus">
                                        &minus;
                                    </button>
                                    <input type="number" class="form-control text-center" id="quantity" name="quantity" 
                                        min="1" max="10" value="1">
                                    <button type="button" class="btn btn-outline-secondary" id="plus">
                                        &plus;
                                    </button>
                                    
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex mt-auto">
                                <button type="button" class="btn btn-primary flex-grow-1" onclick="addToCart()">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </button>
                                <a href="{{ route('checkout.shipping_info') }}" class="btn btn-success flex-grow-1">
                                    <i class="fas fa-credit-card me-2"></i> Checkout
                                </a>
                            </div>
                        </form>
                        
                        <!-- Additional Info -->
                        <div class="additional-info mt-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <span>Secure Payment</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-truck text-primary me-2"></i>
                                <span>Fast Digital Delivery</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-headset text-primary me-2"></i>
                                <span>24/7 Customer Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Full Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">{{ $product->name }} - Full Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! htmlspecialchars_decode($product->description) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
<div class="container-fluid bg-white py-5">
    <div class="container">
        <h2 class="text-center mb-4">Related Products</h2>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach (filter_products(\App\Models\Product::where('category_id', $product->category_id)->where('id', '!=', $product->id))->limit(4)->get() as $key => $related_product)
                <div class="col">
                    <div class="card h-100 product-card shadow-sm border-0 transition-hover">
                        <div class="position-relative">
                            <a href="{{ route('product', $related_product->slug) }}">
                                <img src="{{ asset($related_product->thumbnail_img) }}" 
                                    class="card-img-top product-img" 
                                    alt="{{ $related_product->name }}">
                            </a>
                            @if($related_product->discount > 0)
                                <div class="position-absolute top-0 end-0 bg-danger text-white m-2 px-2 py-1 rounded">
                                    {{ $related_product->discount_type == 'amount' ? currency_symbol() . $related_product->discount : $related_product->discount . '%' }} OFF
                                </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            @if($related_product->category_id)
                                @php
                                    $category = \App\Models\Category::find($related_product->category_id);
                                @endphp
                                @if($category)
                                    <div class="mb-2">
                                        <span class="badge bg-light text-primary">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                @endif
                            @endif
                            
                            <h5 class="card-title product-title">
                                <a href="{{ route('product', $related_product->slug) }}" class="text-decoration-none text-dark">
                                    {{ str_limit($related_product->name, 30) }}
                                </a>
                            </h5>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div class="price-container">
                                    <span class="fw-bold text-primary">
                                        {{ currency_symbol() . bcdiv(home_price_formatted($related_product->id), 1, 2) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <button class="btn btn-outline-primary w-100" onclick="addToCart1Step({{ $related_product->id }})">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="display-6 fw-bold mb-3">Any Other Questions?</h2>
                <p class="lead">
                    If there is anything you are unsure of regarding the products we have on offer or just need some advice, 
                    please don't hesitate to get in touch - we are sure we can help!
                </p>
                <a href="{{ route('contactus') }}" class="btn btn-primary btn-lg mt-3">
                    Contact Us <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('frontend/CodeCrafterInnovations/assets/media/stillq.png') }}" 
                    alt="Contact Us" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Change main product image when clicking on thumbnails
    function changeMainImage(imageSrc, element) {
        document.getElementById('main-product-image').src = imageSrc;
        
        // Remove active class from all thumbnails
        document.querySelectorAll('.product-thumbnail').forEach(thumbnail => {
            thumbnail.classList.remove('active');
        });
        
        // Add active class to clicked thumbnail
        element.classList.add('active');
    }

    // Quantity selector functionality
    document.addEventListener('DOMContentLoaded', function() {
        const minusBtn = document.getElementById('minus');
        const plusBtn = document.getElementById('plus');
        const quantityInput = document.getElementById('quantity');
        
        minusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        plusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < 10) {
                quantityInput.value = currentValue + 1;
            }
        });
        
        quantityInput.addEventListener('change', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < 1) {
                quantityInput.value = 1;
            } else if (currentValue > 10) {
                quantityInput.value = 10;
            }
        });
    });
    
    // Initialize cart functionality
    cartQuantityInitialize();
    
    // Update variant price when options change
    $('#option-choice-form input').on('change', function() {
        getVariantPrice();
    });
</script>
@endsection

@section('style')
<style>
    .product-title {
        font-size: 1.75rem;
        font-weight: 600;
    }
    
    .product-main-image {
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 0.375rem;
        overflow: hidden;
    }
    
    .product-main-image img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }
    
    .product-thumbnail {
        width: 70px;
        height: 70px;
        object-fit: cover;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .product-thumbnail.active {
        border: 2px solid var(--bs-primary);
    }
    
    .product-thumbnail:hover {
        transform: scale(1.05);
    }
    
    .quantity-selector {
        max-width: 150px;
    }
    
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
    
    .description-content {
        line-height: 1.6;
    }
    
    .additional-info {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endsection
