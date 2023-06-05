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
        // applicant
        '/applicant/postRegister',
        '/applicant/postLogin',
        '/applicant/postForgotPassword',
        '/applicant/postResetPassword',

        // employer
        '/employer/postRegister',
        '/employer/postLogin',

        // admin
        '/admin/postRegister',
        // '/admin/postLogin',
    ];
}
