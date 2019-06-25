<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/weixin',
        '/weixin_auth_callback',
        '/notify',
        '/notify_bill',
        '/notify_recharge',
        '/notify_tuan',
        '/uploadimg',
        'updateAccountprice'
    ];
}
