<?php

namespace Phpfox\Paging;

return [
    'pagination.decorators' => [
        'default' => SlidingDecorator::class,
    ],
    'services'              => [
        'pagination' => [null, Pagination::class],
    ],
];