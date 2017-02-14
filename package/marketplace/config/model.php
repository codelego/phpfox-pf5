<?php

namespace Neutron\Marketplace\Model;

return [
    'marketplace_category' => [
        'table_factory',
        ':marketplace_category',
        MarketplaceCategory::class,
        'package/marketplace/config/model/marketplace_category.php',
    ],
];