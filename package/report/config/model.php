<?php

namespace Neutron\Report\Model;

return [
    'report_category' => [
        'table_factory',
        ':report_category',
        ReportCategory::class,
        'package/report/config/model/category.php',
    ],
    'report'          => [
        'table_factory',
        ':report',
        Report::class,
        'package/report/config/model/report.php',
    ],
];