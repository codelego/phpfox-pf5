<?php

namespace Phpfox\Mailer {

    return [
        'psr4'            => [
            'Phpfox\\Mailer\\' => [
                'library/phpfox-mailer/src',
                'library/phpfox-mailer/test',
            ],
        ],
        'mail.transports' => [
            'smtp'      => SmtpTransport::class,
            'system'    => SystemTransport::class,
            'man_drill' => MandrillMailTransport::class,
            'send_grid' => MailTransportSendGrid::class,
            'ses'       => SesMailTransport::class,
        ],
        'service.map'     => [
            'mail.transport' => [null, TransportManager::class,],
        ],
    ];
}