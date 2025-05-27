<?php

return [
    'navigation_label' => 'Anggota',
    'resources' => [
        'label' => 'Anggota',
        'plural_label' => 'Anggota',
        'list' => 'Daftar Anggota',
    ],
    'fields' => [
        'name' => 'Nama',
        'member_code' => 'Kode Anggota',
        'email' => 'Email',
        'phone' => 'Telepon',
        'address' => 'Alamat',
        'is_active' => 'Aktif',
    ],
    'validation' => [
        'member_code_unique' => 'Kode anggota sudah digunakan.',
    ],
    'report_print' => [
        'title' => 'Laporan Anggota',
        'header' => 'Laporan Data Anggota',
        'print_at' => 'Tanggal cetak: :date',
        'columns' => [
            'member_code' => 'Kode Anggota',
            'name' => 'Nama',
            'email' => 'Email',
            'phone' => 'Telepon',
            'address' => 'Alamat',
            'is_active' => 'Aktif',
        ],
    ],
];
