<?php

namespace Neutron\Contact\Model;

return [
    'contact_department' => [
        'table_factory',
        ':contact_department',
        Department::class,
        'package/contact/config/model/department.php',
    ],
];