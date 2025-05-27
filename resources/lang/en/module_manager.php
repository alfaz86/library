<?php

return [
    'title' => 'Module Manager',
    'navigation_group' => 'Settings',
    'navigation_label' => 'Module Manager',
    'breadcrumbs' => [
        'title' => 'Settings',
        'module_manager' => 'Module Manager',
    ],
    'module_enabled' => ':module has been enabled.',
    'module_disabled' => ':module has been disabled.',
    'modules' => [
        'fines' => [
            'title' => 'Fines Module',
            'status' => [
                'enabled' => 'Enabled',
                'disabled' => 'Disabled',
            ],
            'description' => 'Module for managing book borrowing fines.',
            'actions' => [
                'enable' => 'Enable',
                'disable' => 'Disable',
            ],
        ],
        'report' => [
            'title' => 'Report Module',
            'status' => [
                'enabled' => 'Enabled',
                'disabled' => 'Disabled',
            ],
            'description' => 'Module to generate various data related to book management and member data.',
            'actions' => [
                'enable' => 'Enable',
                'disable' => 'Disable',
                'error' => 'An error occurred while enabling the module.',
            ],
        ],
    ]
];