<?php

return [
    'navigation_label' => 'Members',
    'resources' => [
        'label' => 'Member',
        'plural_label' => 'Members',
        'list' => 'Member List',
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
