@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 my-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h3 class="mb-0 font-weight-bold text-center">{{ __('Verify Your Email Address') }}</h3>
                </div>

                <div class="card-body p-5">
                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <div class="verification-icon mb-4">
                            <i class="fa fa-envelope-open-text fa-5x text-primary animated pulse infinite slower"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">{{ __('One Last Step!') }}</h4>
                        <p class="text-muted lead">{{ __('Please verify your email address to complete your registration') }}</p>
                    </div>

                    <div class="verification-info p-4 bg-light rounded mb-4">
                        <p class="mb-1">
                            <i class="fa fa-info-circle text-primary mr-2"></i>
                            {{ __('We\'ve sent a verification link to your email address.') }}
                        </p>
                        <p class="mb-1">
                            <i class="fa fa-check-circle text-primary mr-2"></i>
                            {{ __('Check your inbox and click on the link to verify your account.') }}
                        </p>
                        <p class="mb-0">
                            <i class="fa fa-question-circle text-primary mr-2"></i>
                            {{ __('Didn\'t receive the email? Check your spam folder or request a new link below.') }}
                        </p>
                    </div>

                    <div class="text-center">
                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fa fa-paper-plane mr-2"></i>{{ __('Resend Verification Email') }}
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="card-footer bg-light text-center py-3">
                    <p class="text-muted mb-0">
                        <i class="fa fa-lock mr-1"></i>
                        {{ __('This step helps us ensure the security of your account') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animated {
        animation-duration: 3s;
        animation-fill-mode: both;
        animation-iteration-count: infinite;
    }
    
    .pulse {
        animation-name: pulse;
    }
    
    .slower {
        animation-duration: 4s;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    
    .verification-info {
        border-left: 4px solid #4e73df;
    }
</style>
@endsection
