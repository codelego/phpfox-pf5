<?php

namespace Neutron\ContactUs\Model;

return [
    'contact_department' => [
        'table_factory',
        ':contact_department',
        ContactDepartment::class,
        'contact-us/config/.meta.contact_department.php',
    ],
];