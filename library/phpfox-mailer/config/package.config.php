<?php

namespace Phpfox\Mailer;

return [
    'psr4'              => [
        'Phpfox\\Mailer\\' => [
            'library/phpfox-mailer/src',
            'library/phpfox-mailer/test',
        ],
    ],
    'mailer.transports' => [
        'smtp'   => SmtpMailTransport::class,
        'system' => SystemMailTransport::class,
    ],
    'services'          => [
        'mailer'         => [null, MailFacades::class,],
        'mailer.factory' => null,
    ],
];
