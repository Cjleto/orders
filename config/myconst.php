<?php

return [
    'initial_role_permissions' => [
        'admin' => [
            'manage_users',
            'manage_roles',
            'manage_orders',
            'manage_customers',
            'manage_products'
        ],
        'customer' => [
            'manage_orders',
            'manage_customers',
            'manage_products'
        ]
    ],
    'currency_symbol' => env('CURRENCY_SYMBOL', '€'),
];
