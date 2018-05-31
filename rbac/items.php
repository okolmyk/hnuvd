<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'registration' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'create' => [
        'type' => 2,
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'manager',
        ],
    ],
    'monitor' => [
        'type' => 1,
        'children' => [
            'login',
            'logout',
            'index',
            'view',
        ],
    ],
    'manager' => [
        'type' => 1,
        'children' => [
            'create',
            'update',
            'delete',
            'monitor',
        ],
    ],
];
