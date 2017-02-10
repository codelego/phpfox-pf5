<?php

namespace Neutron\Report\Model;

return [
    'report_category' => [
        'table_factory',
        ':report_category',
        Category::class,
        'report/config/.meta.category.php',
    ],
    'report'          => [
        'table_factory',
        ':report',
        Report::class,
        'report/config/.meta.report.php',
    ],
];