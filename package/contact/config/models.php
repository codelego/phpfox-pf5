<?php

namespace Neutron\Contact\Model;

return [
    'contact_department' => [
        'table_factory',
        ':contact_department',
        Department::class,
        'contact/config/.meta.department.php',
    ],
];