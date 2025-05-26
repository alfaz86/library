<?php

return [
    'navigation_label' => 'Peminjaman',
    'resources' => [
        'label' => 'Peminjaman',
        'plural_label' => 'Peminjaman',
        'list' => 'Daftar Peminjaman',
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
        'member_id' => 'Anggota',
        'loan_date' => 'Tanggal Pinjam',
        'due_date' => 'Jatuh Tempo',
        'status' => 'Status',
        'loan_books' => 'Daftar Buku',
        'book_id' => 'Buku',
        'add_book' => 'Tambah Buku',
    ],
    'status' => [
        'borrow' => 'Meminjam',
        'returned' => 'Dikembalikan',
        'late' => 'Terlambat',
    ],
    'table' => [
        'columns' => [
            'book_count' => 'Jumlah Buku',
        ],
    ],
    'notifications' => [
        'loan_created' => 'Peminjaman berhasil dibuat.',
        'loan_updated' => 'Peminjaman berhasil diperbarui.',
        'loan_deleted' => 'Peminjaman berhasil dihapus.',
        'loan_deleted_detail' => 'Berhasil menghapus :deleted Peminjaman.',
        'loan_can\'t_be_deleted_title' => 'Beberapa Peminjaman tidak dapat dihapuskan.',
        'loan_can\'t_be_deleted_body' => 'Peminjaman dengan status "Dikembalikan" atau "Terlambat" tidak dapat dihapus.',
    ],
];
