<?php

return [
    'navigation_label' => 'Buku',
    'resources' => [
        'label' => 'Buku',
        'plural_label' => 'Buku',
        'list' => 'Daftar Buku',
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
        'title' => 'Judul',
        'author' => 'Pengarang',
        'isbn' => 'ISBN',
        'publisher' => 'Penerbit',
        'published_year' => 'Tahun Terbit',
        'category' => 'Kategori',
        'language' => 'Bahasa',
        'pages' => 'Jumlah Halaman',
        'shelf_location' => 'Lokasi Rak',
        'stock' => 'Stok',
        'available' => 'Tersedia',
        'cover_image' => 'Gambar Sampul',
    ],
    'validation' => [
        'isbn_unique' => 'Nomor ISBN sudah digunakan.',
    ],
    'table' => [
        'columns' => [
            'available' => [
                'true' => 'Tersedia',
                'false' => 'Tidak Tersedia',
            ],
            'stock_remaining' => 'Sisa Stok',
        ],
        'current_borrowers' => [
            'title' => 'Peminjam Saat Ini',
            'empty' => 'Tidak ada peminjam saat ini.',
            'borrower' => 'Peminjam',
            'borrowed_at' => 'Dipinjam pada',
            'due_date' => 'Tanggal Jatuh Tempo',
        ],
    ],
    'report_print' => [
        'title' => 'Laporan Buku',
        'header' => 'Laporan Data Buku',
        'print_at' => 'Tanggal cetak: :date',
        'columns' => [
            'book' => 'Buku',
            'detail' => 'Detail Buku',
            'title' => 'Judul',
            'author' => 'Pengarang',
            'isbn' => 'ISBN',
            'publisher' => 'Penerbit',
            'published_year' => 'Tahun Terbit',
            'category' => 'Kategori',
            'language' => 'Bahasa',
            'pages' => 'Jumlah Halaman',
            'shelf_location' => 'Lokasi Rak',
            'stock' => 'Stok',
            'available' => 'Tersedia',
        ],
    ],
];
