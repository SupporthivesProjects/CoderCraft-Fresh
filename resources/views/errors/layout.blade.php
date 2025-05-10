@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-template">
                <h1 class="display-1">@yield('code')</h1>
                <h2>@yield('title')</h2>
                <div class="error-details my-4">
                    <p>@yield('message')</p>
                </div>
                <div class="error-actions mt-4">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    <a href="{{ route('contactus') }}" class="btn btn-outline-secondary btn-lg ms-2">
                        <i class="fas fa-envelope me-2"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .error-template {
        padding: 40px 15px;
    }
    .error-template .display-1 {
        font-size: 8rem;
        font-weight: 700;
        color: #007bff;
    }
    .error-actions {
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .error-actions .btn {
        margin-right: 10px;
    }
</style>
@endsection