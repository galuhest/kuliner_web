<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'outlet-types*',
        'product-types*',
        'outlets*',
        'users*',
        'orders*',
        'menu*',
        'regions*',
        'areas*',
        'districts*'
    ];
}
