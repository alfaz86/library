<?php

return [
    'title' => 'Pengelola Modul',
    'navigation_group' => 'Pengaturan',
    'navigation_label' => 'Pengelola Modul',
    'breadcrumbs' => [
        'title' => 'Pengaturan',
        'module_manager' => 'Pengelola Modul',
    ],
    'module_enabled' => ':module telah diaktifkan.',
    'module_disabled' => ':module telah dinonaktifkan.',
    'modules' => [
        'fines' => [
            'title' => 'Modul Denda',
            'status' => [
                'enabled' => 'Diaktifkan',
                'disabled' => 'Dinonaktifkan',
            ],
            'description' => 'Modul untuk mengelola denda peminjaman buku.',
            'actions' => [
                'enable' => 'Aktifkan',
                'disable' => 'Nonaktifkan',
                'error' => 'Terjadi kesalahan saat mengaktifkan modul.',
            ],
        ],
    ]
];