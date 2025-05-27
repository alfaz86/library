<?php

return [
    'navigation_label' => 'Loans',
    'resources' => [
        'label' => 'Loan',
        'plural_label' => 'Loans',
        'list' => 'Loan List',
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
    'notifications' => [
        'loan_created' => 'Loan successfully created.',
        'loan_updated' => 'Loan successfully updated.',
        'loan_deleted' => 'Loan successfully deleted.',
        'loan_deleted_detail' => 'Successfully deleted :deleted loans.',
        'loan_can\'t_be_deleted_title' => 'Some loans cannot be deleted.',
        'loan_can\'t_be_deleted_body' => 'Loans with "Returned" or "Late" status cannot be deleted.',
    ],
    'report_print' => [
        'title' => 'Loan Report',
        'header' => 'Loan Data Report',
        'print_at' => 'Printed on: :date',
        'columns' => [
            'member' => 'Member',
            'loan_date' => 'Loan Date',
            'due_date' => 'Due Date',
            'status' => 'Status',
            'book_count' => 'Book Count',
            'loan_return' => [
                'return_date' => 'Return Date',
                'fine' => 'Fine',
                'no_return' => 'Not return yet',
            ]
        ],
    ],
];
