<?php

namespace Phpfox\Mailer;

return [
    'mail_drivers' => [
        'smtp'   => SmtpAdapter::class,
        'system' => SystemAdapter::class,
    ],
    'services'     => [
        'mailer' => [null, MailFacades::class,],
    ],
];
