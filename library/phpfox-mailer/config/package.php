<?php

namespace Phpfox\Mailer;

return [
    'mail.drivers' => [
        'smtp'   => SmtpMailAdapter::class,
        'system' => SystemMailAdapter::class,
    ],
    'services'          => [
        'mailer'         => [null, MailFacades::class,],
        'mailer.factory' => null,
    ],
];
