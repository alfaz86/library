<?php

return [
    'resources' => [
        'label' => 'Loan',
        'plural_label' => 'Loans',
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
        'member_id' => 'Member',
        'loan_date' => 'Loan Date',
        'due_date' => 'Due Date',
        'status' => 'Status',
        'loan_books' => 'Book List',
        'book_id' => 'Book',
        'add_book' => 'Add Book',
    ],
    'status' => [
        'borrow' => 'Borrow',
        'returned' => 'Returned',
        'late' => 'Late',
    ],
    'table' => [
        'columns' => [
            'book_count' => 'Book Count',
        ],
    ],
];
