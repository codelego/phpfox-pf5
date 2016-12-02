<?php

namespace Phpfox\Mail {

    return [
        'autoload.psr4' => [
            'Phpfox\\Mail\\' => [
                'library/phpfox-mail/src',
                'library/phpfox-mail/test',
            ],
        ],
        'service.map'   => [
            'mail.transport' => [null, MailTransportManager::class,],
        ],
    ];
}