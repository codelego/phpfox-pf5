<?php

namespace Phpfox\Validate;

return [
    'validator_rules' => [
        'required' => RequiredValidate::class,
        'string'   => StringValidate::class,
        'email'    => EmailAddressValidate::class,
        'int'      => IntegerValidate::class,
        'ip'       => IpValidate::class,
        'url'      => UrlValidate::class,
        'callback' => CallbackValidate::class,
        'unique'   => UniqueValidate::class,
    ],
    'services'        => [
        'validator' => [null, ValidateManager::class],
    ],
];