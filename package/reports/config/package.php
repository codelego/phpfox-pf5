<?php
namespace Neutron\AbuseReport;


return [
    'services'  => [
        'abuse_report' => [null, Service\Reports::class],
    ],
    'templates' => _view_map(['default' => ['abuse-report' => 'package/abuse-reports/view']]),
];