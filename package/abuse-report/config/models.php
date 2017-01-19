<?php

namespace Neutron\AbuseReport\Model;

return [
    'abuse_report_category' => [
        'table_factory',
        ':abuse_report_category',
        AbuseReportCategory::class,
        'abuse-report/config/.meta.abuse_report_category.php',
    ],
];