<?php

return [
    'initial_role_permissions' => [
        'admin' => [
            'manage_users',
            'manage_roles',
            'manage_orders',
            'manage_customers',
        ],
        'customer' => [
            'manage_orders',
            'manage_customers'
        ]
    ],

];
