<?php

namespace Phpfox\Navigation;

return [
    'navigation.decorators' => [
        'vertical_dropdown' => VerticalDropDownMenu::class,
    ],
    'service.map'           => [
        'navigation' => [null, NavigationManager::class],
    ],
];