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
        'invoice/paytm/*',
        'invoice/mollie/*',
        '/plan/iyzipay/*',
        '/invoice/iyzipay/*',
        '/plan/aamarpay/*',
        '/invoice/aamarpay/*'
    ];
}
