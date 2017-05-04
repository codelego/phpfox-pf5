<?php

namespace Neutron\Report;


return [
    'services'  => [
        'reports' => [null, Service\ReportManager::class],
    ],
    'templates' => _view_map(['default' => ['report' => 'package/report/view']]),
];