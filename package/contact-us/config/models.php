<?php

namespace Neutron\ContactUs\Model;

return [
    'contact_department' => [
        'table_factory',
        ':contact_department',
        Department::class,
        'contact-us/config/.meta.contact_department.php',
    ],
];