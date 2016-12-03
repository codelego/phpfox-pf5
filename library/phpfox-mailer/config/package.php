<?php

namespace Phpfox\Mailer;

return [
    'psr4'            => [
        'Phpfox\\Mailer\\' => [
            'library/phpfox-mailer/src',
            'library/phpfox-mailer/test',
        ],
    ],
    'mail.transports' => [
        'smtp'   => SmtpMailTransport::class,
        'system' => SystemMailTransport::class,
    ],
    'service.map'     => [
        'mail.transport' => [null, MailFacades::class,],
        'mail.template'  => [null, MailTemplate::class, null],
    ],
];
