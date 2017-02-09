<?php

namespace Neutron\AbuseReport\Model;

return [
    'report_category' => [
        'table_factory',
        ':report_category',
        Category::class,
        'abuse-reports/config/.meta.report_category.php',
    ],
    'report'          => [
        'table_factory',
        ':report',
        Report::class,
        'reports/config/.meta.report.php',
    ],
];