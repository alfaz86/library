<?php

return [
    'title' => 'Pengaturan Denda',
    'navigation_group' => 'Pengaturan',
    'navigation_label' => 'Pengaturan Denda',
    'breadcrumbs' => [
        'title' => 'Pengaturan',
        'fines' => 'Pengaturan Denda',
    ],
    'form' => [
        'fine_amount' => 'Jumlah Denda',
        'fine_interval' => 'Interval Denda',
        'fine_type' => 'Jenis Denda',
        'max_days' => 'Maksimal Hari Terlambat',
        'fine_intervals' => [
            'day' => 'Hari',
            'week' => 'Minggu',
            'month' => 'Bulan',
            'year' => 'Tahun',
        ],
        'fine_types' => [
            'per_item' => 'Per Item',
            'per_loan' => 'Per Pinjaman',
        ],
    ],
    'notifications' => [
        'save_success' => 'Pengaturan denda berhasil disimpan.',
        'save_error' => 'Terjadi kesalahan saat menyimpan pengaturan denda.',
    ],
];