<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/currency',
        'currency/*',
        '/citigate/success',
        '/citigate/cancel',
        '/citigate/fail',
        '/citigate/ipn',
        '/sslcommerz/success',
        '/sslcommerz/cancel',
        '/sslcommerz/fail',
        '/sslcommerz/ipn',
        '/config_content',
        '/paytm*',
        'cart/addToCart1Step'

    ];
}
