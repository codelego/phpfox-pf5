<?php

namespace Neutron\Report\Model;

return [
    'report_category' => [
        'table_factory',
        ':report_category',
        ReportCategory::class,
        'package/report/config/model/category.php',
    ],
    'report_item'     => [
        'table_factory',
        ':report_item',
        ReportItem::class,
        'package/report/config/model/report_item.php',
    ],
];