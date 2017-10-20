<?php

namespace Neutron\Dev\Model;

return [
    'dev_action'  => [
        'table_factory',
        ':dev_action',
        DevAction::class,
        'package/dev/config/model/dev_action.php',
    ],
    'dev_table'   => [
        'table_factory',
        ':dev_table',
        DevTable::class,
        'package/dev/config/model/dev_table.php',
    ],
    'dev_element' => [
        'table_factory',
        ':dev_element',
        DevElement::class,
        'package/dev/config/model/dev_element.php',
    ],
    'dev_model'   => [
        'table_factory',
        ':dev_model',
        DevModel::class,
        'package/dev/config/model/dev_model.php',
    ],
    'dev_form'    => [
        'table_factory',
        ':dev_form',
        DevForm::class,
        'package/dev/config/model/dev_form.php',
    ],
];