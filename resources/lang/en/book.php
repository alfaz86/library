<?php

return [
    'resources' => [
        'label' => 'Book',
        'plural_label' => 'Books',
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
];
