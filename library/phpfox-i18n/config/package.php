<?php

namespace Phpfox\I18n {

    return [
        'psr4' => [
            'Phpfox\\I18n\\' => [
                'library/phpfox-i18n/src',
                'library/phpfox-i18n/test',
            ],
        ],
        'service.map'   => [
            'translator' => [null, Translator::class,],
        ],
    ];
}
