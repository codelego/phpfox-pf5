<?php

return [
    'chains' => [
        'profile' => [
            'route'  => '{groups}/<name>/*',
            'filter' => 'group.callback@filterProfileName',
        ],
    ],
];