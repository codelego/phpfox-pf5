<?php
namespace Neutron\AbuseReport;


return [
    'services'  => [
        'abuse_report' => [null, Service\AbuseReport::class],
    ],
    'templates' => _view_map(['default' => ['abuse-report' => 'package/abuse-report/view']]),
];