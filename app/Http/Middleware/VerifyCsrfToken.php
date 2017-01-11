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
        'app/login',
        'app/register',
        'app/troubles',
        'app/map',
        'app/troubles/store',
        'app/troubles/update',
        'app/troubles/all',
        'app/troubles/edit'
    ];
}
