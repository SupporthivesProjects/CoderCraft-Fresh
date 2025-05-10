@extends('frontend.layouts.app')

@section('content')
<section class="error">
    <div class="error_div1">
        <div class="inner_error">
            <div class="text_error">
                <h3 class="heading_error">oops, we lost you somewhere!</h3>
                <p class="para_error">Let us help you find your way back.</p>
            </div>
            <button class="btn btn_error" onclick="window.location.href='{{ route('home') }}'">Take Me Home</button>
        </div>

    </div>
</section>
@endsection

@section('styles')
<style>
    .error-template {
        padding: 40px 15px;
    }
    .error-template .display-1 {
        font-size: 8rem;
        font-weight: 700;
        color: #fd7e14;
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