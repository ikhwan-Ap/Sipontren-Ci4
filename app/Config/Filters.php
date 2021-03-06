<?php

namespace Config;

use App\Filters\KeamananFilter;
use App\Filters\LoginFilter;
use App\Filters\RegisterFilter;
use App\Filters\SantriFilter;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'isLoggedIn' => LoginFilter::class,
        'isRegister' => RegisterFilter::class,
        'isSantri' => SantriFilter::class,
        'isKeamananLogin' => KeamananFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'isLoggedIn' => [
            'before' => [
                'santri',
                'santri/*',
                'admin',
                'admin/*',
                'program',
                'program/*',
                'gedung',
                'perizinan',
                'perizinan/*',
                'gedung/*',
                'alumni',
                'alumni/*',
                '/dashboard'

            ],
        ],
        'isSantri' => [
            'before' => [
                'dashboard/santri',
                'santri/biodata',
                'santri/profil',
                'santri/pembayaran',
            ],
        ],
        'isKeamananLogin' => [
            'before' => [
                'perizinan/keamanan',
            ],

        ],
    ];
}
