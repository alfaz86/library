<?php

return [
    'resources' => [
        'label' => 'Pinjaman',
        'plural_label' => 'Daftar Pinjaman',
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
        'loan_created' => 'Pinjaman berhasil dibuat.',
        'loan_updated' => 'Pinjaman berhasil diperbarui.',
        'loan_deleted' => 'Pinjaman berhasil dihapus.',
        'loan_deleted_detail' => 'Berhasil menghapus :deleted pinjaman.',
        'loan_can\'t_be_deleted_title' => 'Beberapa pinjaman tidak dapat dihapuskan.',
        'loan_can\'t_be_deleted_body' => 'Pinjaman dengan status "Dikembalikan" atau "Terlambat" tidak dapat dihapus.',
    ],
];
