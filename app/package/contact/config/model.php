<?php

namespace Neutron\Contact\Model;

return [
    'contact_department' => [
        'table_factory',
        ':contact_department',
        ContactDepartment::class,
        'package/contact/config/model/contact_department.php',
    ],
];