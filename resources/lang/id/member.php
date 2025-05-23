<?php

return [
    'resources' => [
        'label' => 'Anggota',
        'plural_label' => 'Daftar Anggota',
    ],
    'pages' => [
        'index' => [
            'label' => 'Semua :label',
        ],
        'create' => [
            'label' => 'Tambah :label',
        ],
        'edit' => [
            'label' => 'Ubah :label',
        ],
        'view' => [
            'label' => 'Lihat :label',
        ],
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
