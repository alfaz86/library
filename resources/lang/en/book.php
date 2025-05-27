<?php

return [
    'navigation_label' => 'Books',
    'resources' => [
        'label' => 'Book',
        'plural_label' => 'Books',
        'list' => 'Book List',
    ],
    'pages' => [
        'index' => [
            'label' => 'All :label',
        ],
        'create' => [
            'label' => 'Add :label',
        ],
        'edit' => [
            'label' => 'Edit :label',
        ],
        'view' => [
            'label' => 'View :label',
        ],
    ],
    'fields' => [
        'title' => 'Title',
        'author' => 'Author',
        'isbn' => 'ISBN',
        'publisher' => 'Publisher',
        'published_year' => 'Published Year',
        'category' => 'Category',
        'language' => 'Language',
        'pages' => 'Pages',
        'shelf_location' => 'Shelf Location',
        'stock' => 'Stock',
        'available' => 'Available',
        'cover_image' => 'Cover Image',
    ],
    'validation' => [
        'isbn_unique' => 'The ISBN number has already been used.',
    ],
    'table' => [
        'columns' => [
            'available' => [
                'true' => 'Available',
                'false' => 'Not Available',
            ],
            'stock_remaining' => 'Stock Remaining',
        ],
    ],
    'report_print' => [
        'title' => 'Book Report',
        'header' => 'Book Data Report',
        'print_at' => 'Printed on: :date',
        'columns' => [
            'book' => 'Book',
            'detail' => 'Book Detail',
            'title' => 'Title',
            'author' => 'Author',
            'isbn' => 'ISBN',
            'publisher' => 'Publisher',
            'published_year' => 'Published Year',
            'category' => 'Category',
            'language' => 'Language',
            'pages' => 'Pages',
            'shelf_location' => 'Shelf Location',
            'stock' => 'Stock',
            'available' => 'Available',
        ],
    ],
];
