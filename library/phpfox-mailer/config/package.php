<?php

namespace Phpfox\Mailer {

    return [
        'autoload.psr4'   => [
            'Phpfox\\Mailer\\' => [
                'library/phpfox-mailer/src',
                'library/phpfox-mailer/test',
            ],
        ],
        'mail.transports' => [
            'smtp'      => MailTransportSmtp::class,
            'system'    => MailTransportSystem::class,
            'man_drill' => MailTransportManDrill::class,
            'send_grid' => MailTransportSendGrid::class,
            'ses'       => MailTransportSes::class,
        ],
        'service.map'     => [
            'mail.transport' => [null, MailTransportManager::class,],
        ],
    ];
}