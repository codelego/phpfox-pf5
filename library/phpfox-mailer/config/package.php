<?php

namespace Phpfox\Mailer;

return [
    'mail.drivers' => [
        'smtp'   => SmtpAdapter::class,
        'system' => SystemAdapter::class,
    ],
    'services'          => [
        'mailer'         => [null, MailFacades::class,],
        'mailer.factory' => null,
    ],
];
