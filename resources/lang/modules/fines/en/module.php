<?php

return [
    'title' => 'Fines Settings',
    'navigation_group' => 'Settings',
    'navigation_label' => 'Fines Settings',
    'breadcrumbs' => [
        'title' => 'Settings',
        'fines' => 'Fines Settings',
    ],
    'form' => [
        'fine_amount' => 'Fine Amount',
        'fine_interval' => 'Fine Interval',
        'fine_type' => 'Fine Type',
        'max_days' => 'Maximum Late Days',
        'fine_intervals' => [
            'day' => 'Day',
            'week' => 'Week',
            'month' => 'Month',
            'year' => 'Year',
        ],
        'fine_types' => [
            'per_item' => 'Per Item',
            'per_loan' => 'Per Loan',
        ],
    ],
    'notifications' => [
        'save_success' => 'Fines settings saved successfully.',
        'save_error' => 'An error occurred while saving fines settings.',
    ],
];