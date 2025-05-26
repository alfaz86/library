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
];
