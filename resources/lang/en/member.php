<?php

return [
    'resources' => [
        'label' => 'Member',
        'plural_label' => 'Member List',
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
        'name' => 'Name',
        'member_code' => 'Member Code',
        'email' => 'Email',
        'phone' => 'Phone',
        'address' => 'Address',
        'is_active' => 'Active',
    ],
    'validation' => [
        'member_code_unique' => 'The member code has already been taken.',
    ],
];
