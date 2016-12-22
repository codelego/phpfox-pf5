<?php

namespace Phpfox\Mailer;

return [
    'mailer.transports' => [
        'smtp'   => SmtpMailTransport::class,
        'system' => SystemMailTransport::class,
    ],
    'services'          => [
        'mailer'         => [null, MailFacades::class,],
        'mailer.factory' => null,
    ],
];
