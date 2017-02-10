<?php

namespace Neutron\Contact;

return [
    'services'  => [
        'contact_us' => [null, Service\ContactUs::class],
    ],
    'templates' => _view_map(['default' => ['contact-us' => 'package/contact-us/view']]),
];